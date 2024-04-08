<?php

/**
 * Alunos dos cursos de Extensao (Bloco)
 * Equipe de Moodle da USP
 * https://github.com/moodle-usp
 */
 
namespace lock_enrol_extensao\Service;

use stdClass;

requeri_once('USPDatabase');

class Query_estudantes 
{
    /**
     * Construtor da Class Estudantes.
     * Obtem as informacoes das turmas
     */

    public function estudantes_turma ($cofofeatvceu) 
    {
        $query_estudantes = "
        SELECT 		
            m.codcurceu,
            m.codpes,
            p.nompes,
            e.codema
        FROM 
            MATRICULACURSOCEU AS m
        INNER JOIN 
            PESSOA AS p ON m.codpes = p.codpes
        INNER JOIN 
            EMAILPESSOA AS e ON e.codpes = m.codpes
        INNER JOIN 
            OFERECIMENTOATIVIDADECEU AS o ON m.codcurceu = o.codcurceu
        WHERE 
            o.codofeatvceu = '$cofofeatvceu';
        ";

        return USPDatabase::fetchAll($query_estudantes);
    }

    }

