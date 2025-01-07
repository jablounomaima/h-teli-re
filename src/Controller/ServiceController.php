<?php

namespace App\Controller;
use App\Repository\ServiceRepository;
use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/add', name: 'service_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vous pouvez ajouter des vérifications spécifiques ici, si nécessaire

            // Persister les données du service
            $entityManager->persist($service);
            $entityManager->flush();

            // Ajouter un message flash de succès
            $this->addFlash('success', 'Service créé avec succès !');

            // Rediriger vers une route valide (par exemple, une liste des services)
            return $this->redirectToRoute('service_list');
        }

        return $this->render('service/add_service.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/services', name: 'service_list', methods: ['GET'])]
    public function listServices(ServiceRepository $serviceRepository): Response
    {

        $services = $serviceRepository->findAll();

        return $this->render('service/list_service.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('service/{id}/edit', name: 'service_edit')]
    public function editService(
        int $id,
        ServiceRepository $serviceRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $service = $serviceRepository->find($id);

        if (!$service) {
            throw $this->createNotFoundException('The service does not exist.');
        }

        $form = $this->createForm(ServiceType::class, $service);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Service updated successfully.');

            return $this->redirectToRoute('service_list');
        }

        return $this->render('service/edit_service.html.twig', [
            'form' => $form->createView(),
            'service' => $service,
        ]);
    }

    #[Route('service/{id}/delete', name: 'service_delete', methods: ['POST'])]
    public function deleteService(
        int $id,
        ServiceRepository $serviceRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $service = $serviceRepository->find($id);

        if (!$service) {
            $this->addFlash('error', 'Service not found!');
            return $this->redirectToRoute('service_list');
        }

        $entityManager->remove($service);
        $entityManager->flush();
        $this->addFlash('success', 'Service deleted successfully!');

        return $this->redirectToRoute('service_list');
    }





}