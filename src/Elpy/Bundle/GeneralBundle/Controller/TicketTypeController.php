<?php

namespace Elpy\Bundle\GeneralBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Elpy\Bundle\GeneralBundle\Entity\TicketType;
use Elpy\Bundle\GeneralBundle\Form\TicketTypeType;

/**
 * TicketType controller.
 *
 */
class TicketTypeController extends Controller
{

    /**
     * Lists all TicketType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ElpyGeneralBundle:TicketType')->findAll();

        return $this->render('ElpyGeneralBundle:TicketType:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TicketType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TicketType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tickettype_show', array('id' => $entity->getId())));
        }

        return $this->render('ElpyGeneralBundle:TicketType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TicketType entity.
     *
     * @param TicketType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TicketType $entity)
    {
        $form = $this->createForm(new TicketTypeType(), $entity, array(
            'action' => $this->generateUrl('tickettype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TicketType entity.
     *
     */
    public function newAction()
    {
        $entity = new TicketType();
        $form   = $this->createCreateForm($entity);

        return $this->render('ElpyGeneralBundle:TicketType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TicketType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:TicketType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TicketType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ElpyGeneralBundle:TicketType:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TicketType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:TicketType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TicketType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ElpyGeneralBundle:TicketType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TicketType entity.
    *
    * @param TicketType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TicketType $entity)
    {
        $form = $this->createForm(new TicketTypeType(), $entity, array(
            'action' => $this->generateUrl('tickettype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TicketType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:TicketType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TicketType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tickettype_edit', array('id' => $id)));
        }

        return $this->render('ElpyGeneralBundle:TicketType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TicketType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ElpyGeneralBundle:TicketType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TicketType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tickettype'));
    }

    /**
     * Creates a form to delete a TicketType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tickettype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
