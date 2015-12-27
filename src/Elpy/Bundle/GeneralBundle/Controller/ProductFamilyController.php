<?php

namespace Elpy\Bundle\GeneralBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Elpy\Bundle\GeneralBundle\Entity\ProductFamily;
use Elpy\Bundle\GeneralBundle\Form\ProductFamilyType;

/**
 * ProductFamily controller.
 *
 */
class ProductFamilyController extends Controller
{

    /**
     * Lists all ProductFamily entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ElpyGeneralBundle:ProductFamily')->findAll();

        return $this->render('ElpyGeneralBundle:ProductFamily:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ProductFamily entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProductFamily();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productfamily_show', array('id' => $entity->getId())));
        }

        return $this->render('ElpyGeneralBundle:ProductFamily:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProductFamily entity.
     *
     * @param ProductFamily $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductFamily $entity)
    {
        $form = $this->createForm(new ProductFamilyType(), $entity, array(
            'action' => $this->generateUrl('productfamily_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductFamily entity.
     *
     */
    public function newAction()
    {
        $entity = new ProductFamily();
        $form   = $this->createCreateForm($entity);

        return $this->render('ElpyGeneralBundle:ProductFamily:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductFamily entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:ProductFamily')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductFamily entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ElpyGeneralBundle:ProductFamily:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductFamily entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:ProductFamily')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductFamily entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ElpyGeneralBundle:ProductFamily:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProductFamily entity.
    *
    * @param ProductFamily $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductFamily $entity)
    {
        $form = $this->createForm(new ProductFamilyType(), $entity, array(
            'action' => $this->generateUrl('productfamily_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductFamily entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:ProductFamily')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductFamily entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('productfamily_edit', array('id' => $id)));
        }

        return $this->render('ElpyGeneralBundle:ProductFamily:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProductFamily entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ElpyGeneralBundle:ProductFamily')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductFamily entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('productfamily'));
    }

    /**
     * Creates a form to delete a ProductFamily entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productfamily_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
