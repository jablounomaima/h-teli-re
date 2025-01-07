<?php

namespace App\Controller;
use App\Repository\HotelRepository;
use App\Entity\Hotel;
use App\Form\HotelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{

    #[Route('/create', name: 'admin_hotel_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('imagePath')->getData();
            if ($image) {
                // Générer un nom unique pour le fichier image
                $newFilename = uniqid() . '.' . $image->guessExtension();

                // Déplacer l'image vers le répertoire configuré
                try {
                    $image->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'exception si le déplacement échoue
                    $this->addFlash('error', 'Erreur lors de l\'upload de l\'image.');
                    return $this->render('hotel/add_hotel.html.twig', [
                        'form' => $form->createView(),
                    ]);
                }

                // Mettre à jour l'entité Hôtel avec le nom du fichier
                $hotel->setImagePath($newFilename);
            }

            // Persister les données de l'hôtel
            $entityManager->persist($hotel);
            $entityManager->flush();

            // Ajouter un message flash de succès
            $this->addFlash('success', 'Hôtel créé avec succès !');

            // Rediriger vers une route valide (remplacez 'hotel_index' par votre route réelle)
            return $this->redirectToRoute('hotel_list');
        }

        return $this->render('admin/hotel/add_hotel.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/hotels', name: 'hotel_list', methods: ['GET'])]
    public function listHotels (HotelRepository $hotelRepository): Response
    {
        // Récupérer tous les hôtels
        $hotels = $hotelRepository->findAll();

        // Renvoyer une vue Twig avec les données des hôtels
        return $this->render('admin/hotel/list.html.twig', [
            'hotels' => $hotels,
        ]);
    }


    #[Route('/admin/hotel/{id}/edit', name: 'hotel_edit')]
    public function editHotel(int $id, HotelRepository $hotelRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'hôtel par son ID
        $hotel = $hotelRepository->find($id);

        if (!$hotel) {
            throw $this->createNotFoundException('The hotel does not exist.');
        }

        $form = $this->createForm(HotelType::class, $hotel);

        // Gérer la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Hotel updated successfully.');

            return $this->redirectToRoute('hotel_list');
        }
        return $this->render('admin/hotel/hotel_edit.html.twig', [
            'form' => $form->createView(),
            'hotel' => $hotel,
        ]);
    }

    #[Route('/admin/hotel/{id}/delete', name: 'hotel_delete', methods: ['POST'])]
    public function deleteHotel(int $id, HotelRepository $hotelRepository, EntityManagerInterface $entityManager): Response
    {
        // Trouver l'hôtel par son ID
        $hotel = $hotelRepository->find($id);

        if (!$hotel) {
            $this->addFlash('error', 'Hotel not found!');
            return $this->redirectToRoute('hotel_list');
        }

        // Supprimer l'hôtel
        $entityManager->remove($hotel);
        $entityManager->flush();

        // Ajouter un message flash de confirmation
        $this->addFlash('success', 'Hotel deleted successfully!');

        // Rediriger vers la liste des hôtels
        return $this->redirectToRoute('hotel_list');
    }



}




