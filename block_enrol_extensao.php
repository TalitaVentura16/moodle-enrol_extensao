<?php

/**
 * Alunos dos cursos de Extensao (Bloco)
 * Equipe de Moodle da USP
 * https://github.com/moodle-usp
 */

class block_enrol_extensao extends block_base {
    
    public function init() {
        $this->title = "USP alunos de Extensão";
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->text = $this->get_extensao_content();
        $this->content->footer = 'Inserir informações';

        return $this->content;
    }

    private function get_extensao_content() {
        $output = 'Inserir conteúdo do bloco aqui';
        
        return $output;
    }
}
