<?php

namespace Elpy\Bundle\GeneralBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Elpy\Bundle\GeneralBundle\Entity\KnowledgeType;
use Elpy\Bundle\GeneralBundle\Form\KnowledgeTypeType;

/**
 * KnowledgeType controller.
 *
 */
class KnowledgeTypeController extends Controller
{

    /**
     * Lists all KnowledgeType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ElpyGeneralBundle:KnowledgeType')->findAll();

        return $this->render('ElpyGeneralBundle:KnowledgeType:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new KnowledgeType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new KnowledgeType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('knowledgetype_show', array('id' => $entity->getId())));
        }

        return $this->render('ElpyGeneralBundle:KnowledgeType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a KnowledgeType entity.
     *
     * @param KnowledgeType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(KnowledgeType $entity)
    {
        $form = $this->createForm(new KnowledgeTypeType(), $entity, array(
            'action' => $this->generateUrl('knowledgetype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new KnowledgeType entity.
     *
     */
    public function newAction()
    {
        $entity = new KnowledgeType();
        $form   = $this->createCreateForm($entity);

        return $this->render('ElpyGeneralBundle:KnowledgeType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a KnowledgeType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:KnowledgeType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find KnowledgeType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ElpyGeneralBundle:KnowledgeType:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing KnowledgeType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:KnowledgeType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find KnowledgeType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ElpyGeneralBundle:KnowledgeType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a KnowledgeType entity.
    *
    * @param KnowledgeType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(KnowledgeType $entity)
    {
        $form = $this->createForm(new KnowledgeTypeType(), $entity, array(
            'action' => $this->generateUrl('knowledgetype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing KnowledgeType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:KnowledgeType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find KnowledgeType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('knowledgetype_edit', array('id' => $id)));
        }

        return $this->render('ElpyGeneralBundle:KnowledgeType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a KnowledgeType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ElpyGeneralBundle:KnowledgeType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find KnowledgeType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('knowledgetype'));
    }

    /**
     * Creates a form to delete a KnowledgeType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('knowledgetype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
