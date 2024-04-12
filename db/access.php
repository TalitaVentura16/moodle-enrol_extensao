<?php
/**
 * Alunos dos cursos de Extensao (Enrol)
 * Equipe de Moodle da USP
 * https://github.com/moodle-usp
 *
 * Plugin capabilities for the repository_pluginname plugin.
 *
 * @package   repository_pluginname
 * @copyright Year, You Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$capabilities = [

    // Enrol anybody.
    'enrol/pluginname:enrol' => [
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => [
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
        ],
    ],

    // Manage enrolments of users.
    'enrol/pluginname:manage' => [
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => [
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
        ],
    ],

    // Unenrol anybody (including self) - watch out for data loss.
    'enrol/pluginname:unenrol' => [
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => [
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
        ],
    ],

    // Unenrol self - watch out for data loss.
    'enrol/pluginname:unenrolself' => [
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => [],
    ],
];