<?php

/**
 * Alunos dos cursos de Extensao (Enrol)
 * Equipe de Moodle da USP
 * https://github.com/moodle-usp
 * 
 * # Turmas Abertas
 * O objetivo desse aquivo eh obter dentro da base do moodle as turmas cujos cursos do ministrante logago 
 * je foram criados, para que assim sejam capturados os estudantes matriculados dos respectivos cursos 
 * e inscreve-lo dentro do curso no moodle;
 */

 class Turmas_abertas {
    /**
     * Obter atravez das tabelas do moodle as turmas cujos cursos ja estao criados
     * 
     * @param array $codpes e $ $codofeatvceu 
     * 
     * @return array $turmas_abertas e 
     * 
     */

     public static function turmasDisponiveis($ministrante)
     {
         global $DB;
     
         $turmas_abertas = array();
     
         foreach ($ministrante as $codpes) {
             // Consulta SQL para obter as informações dos usuários com base no codpes
             $sql = "
             SELECT
                 e.codpes, 
                 e.codofeatvceu,
                 t.nome_curso_apolo,
                 t.sincronizado_apolo
             FROM
                 {block_extensao_ministrante} AS e
             INNER JOIN
                 {block_extensao_turma} AS t ON e.codofeatvceu = t.id
             WHERE
                 e.codpes = :codpes
             ";
     
             $params = array('codpes' => $codpes);
     
             $results = $DB->get_records_sql($sql, $params);
     
             foreach ($results as $result) {
                 if ($result->sincronizado_apolo == 1) {
                     $turma = array(
                         'codpes' => $result->codpes,
                         'codofeatvceu' => $result->codofeatvceu,
                         'nome_curso_apolo' => $result->nome_curso_apolo,
                         'sincronizado_apolo' => $result->sincronizado_apolo
                     );
                     $turmas_abertas[] = $turma;
                 }
             }
         }
     
         return $turmas_abertas;
     }
     
 }