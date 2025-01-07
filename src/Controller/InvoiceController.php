<?php
// src/Controller/InvoiceController.php
namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Repository\InvoiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceController extends AbstractController
{
    #[Route('/invoice', name: 'invoice_index')]
    public function index(InvoiceRepository $invoiceRepository): Response
    {
        return $this->render('invoice/index.html.twig', [
            'invoices' => $invoiceRepository->findAll(),
        ]);
    }

    #[Route('/invoice/new', name: 'invoice_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('invoice_index');
        }

        return $this->render('invoice/new2.html.twig', [
            'invoice' => $invoice,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/invoice/{id}/edit', name: 'invoice_edit')]
    public function edit(Request $request, Invoice $invoice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('invoice_index');
        }

        return $this->render('invoice/edit.html.twig', [
            'invoice' => $invoice,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/invoice/{id}/delete', name: 'invoice_delete')]
    public function delete(Invoice $invoice, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($invoice);
        $entityManager->flush();

        return $this->redirectToRoute('invoice_index');
    }
}