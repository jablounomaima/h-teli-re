<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }


    #[Route('/ajout2', name: 'reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('resultatAjout');

        }
            return $this->render('reservation/new2.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    #[Route('/resultatAjout', name: 'resultatAjout')]
    public function aff(): Response
    {
        return $this->render('reservation/resultatAjout.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }




//    #[Route('/ajout2', name: 'reservation_create', methods: ['GET', 'POST'])]
//    public function create(Request $request, EntityManagerInterface $em): Response
//    {
//        $reservation = new Reservation(); // Créer une nouvelle instance de l'entité
//        $form = $this->createForm(ReservationType::class, $reservation);
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            // Sauvegarder la réservation dans la base de données
//            $em->persist($reservation);
//            $em->flush();
//
//            // Redirection vers la liste des réservations après l'ajout
//            return $this->redirectToRoute('reservation_list');
//        }

//        return $this->render('reservation/create_reservation.html.twig', [
//            'form' => $form->createView(),
//        ]);







    #[Route('/reservations', name: 'list_reservation2', methods: ['GET'])]
    public function listReservations(ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findAll();

        if (empty($reservations)) {
            $this->addFlash('info', 'Aucune réservation trouvée.');
        }

        return $this->render('reservation/list_reservation.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/reservation/{id}', name: 'reservation_show', methods: ['GET'])]
    public function show(int $id, ReservationRepository $reservationRepository): Response
    {
        $reservation = $reservationRepository->find($id);

        if (!$reservation) {
            throw $this->createNotFoundException("La réservation avec l'ID $id n'existe pas.");
        }

        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/reservation/{id}/edit', name: 'reservation_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        ReservationRepository $reservationRepository,
        int $id
    ): Response {
        $reservation = $reservationRepository->find($id);

        if (!$reservation) {
            throw $this->createNotFoundException("La réservation demandée n'existe pas.");
        }

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($reservation);
            $em->flush();

            $this->addFlash('success', 'Réservation mise à jour avec succès.');

            return $this->redirectToRoute('list_reservation2');
        }

        return $this->render('reservation/reservation_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    #[Route('/reservation/{id}/delete', name: 'reservation_delete', requirements: ['id' => '\d+'], methods: ['POST','GET'])]
    public function deleteReservation(
        ReservationRepository $reservationRepository,
        EntityManagerInterface $entityManager,
        int $id
    ): Response {
        $reservation = $reservationRepository->find($id);

        if (!$reservation) {
            throw $this->createNotFoundException(sprintf('La réservation avec l\'ID %d n\'existe pas.', $id));
        }

        $entityManager->remove($reservation);
        $entityManager->flush();

        $this->addFlash('success', 'Réservation supprimée avec succès.');

        return $this->redirectToRoute('list_reservation2');
    }


}
