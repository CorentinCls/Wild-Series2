<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {   
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }
    
    #[Route('/{id}', methods: ['GET'], requirements: ['id' => '\d+'], name: 'show')]
    public function show(Program $program): Response
    {

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$program.' found in program table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    #[Route('/{program}/seasons/{season}', methods: ['GET'], name: 'showSeason')]
    public function showSeason(Program $program, Season $season): Response
    {
        return $this->render('program/showSeason.html.twig', [
            'program' => $program,
            "season" => $season
        ]);
    }

}
