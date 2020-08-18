<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();
$classeAluno = Aluno::class;
$dql1 = "SELECT a, t, c FROM $classeAluno a JOIN a.telefones t JOIN a.cursos c";
$query = $entityManager->createQuery($dql1);
$alunoList = $query->getResult();

foreach ($alunoList as $aluno){
    $telefones = $aluno->getTelefones()->map(function (Telefone $telefone){
        return $telefone->getNumero();
    })
    ->toArray();

    echo "ID: {$aluno->getId()}\n";
    echo "Nome: {$aluno->getNome()}\n";
    echo "Telefones: " . implode(", ", $telefones);

    $cursos = $aluno->getCursos();

    foreach ($cursos as $curso){
        echo "\tID Curso: {$curso->getId() }\n";
        echo "\tCurso: {$curso->getNome() }\n";
        echo "\n";
    }
}