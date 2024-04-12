<?php

/**
 * Alunos dos cursos de Extensao (Enrol)
 * Equipe de Moodle da USP
 * https://github.com/moodle-usp
 */

defined('MOODLE_INTERNAL') || die();

class enrol_extensao extends enrol_plugin {
    
    public function init() {
        $this->title = get_string('pluginname', 'enrol_extensao');
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
        $output = 'Inserir conteúdo do plugin aqui';
        
        return $output;
    }
}
