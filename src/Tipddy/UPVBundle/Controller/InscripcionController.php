<?php

namespace Tipddy\UPVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Tipddy\UPVBundle\Entity\Inscripcion;
use Tipddy\UPVBundle\Form\InscripcionType;

/**
 * Inscripcion controller.
 *
 */
class InscripcionController extends Controller
{
    /**
     * Lists all Inscripcion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TipddyUPVBundle:Inscripcion')->findAll();

        return $this->render('TipddyUPVBundle:Inscripcion:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Inscripcion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TipddyUPVBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TipddyUPVBundle:Inscripcion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Inscripcion entity.
     *
     */
    public function newAction()
    {
        $entity = new Inscripcion();
        $form   = $this->createForm(new InscripcionType(), $entity);

        return $this->render('TipddyUPVBundle:Inscripcion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Inscripcion entity.
     *
     */
    public function createAction()
    {
        $entity  = new Inscripcion();
        $request = $this->getRequest();
        $form    = $this->createForm(new InscripcionType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('inscripcion_show', array('id' => $entity->getId())));
            
        }

        return $this->render('TipddyUPVBundle:Inscripcion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Inscripcion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TipddyUPVBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $editForm = $this->createForm(new InscripcionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TipddyUPVBundle:Inscripcion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Inscripcion entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TipddyUPVBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $editForm   = $this->createForm(new InscripcionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('inscripcion_edit', array('id' => $id)));
        }

        return $this->render('TipddyUPVBundle:Inscripcion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Inscripcion entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TipddyUPVBundle:Inscripcion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Inscripcion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('inscripcion'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
