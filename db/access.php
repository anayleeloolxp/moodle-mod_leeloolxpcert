<?php


// This file is part of the leeloolxpcert module for Moodle - http://moodle.org/


//


// Moodle is free software: you can redistribute it and/or modify


// it under the terms of the GNU General Public License as published by


// the Free Software Foundation, either version 3 of the License, or


// (at your option) any later version.


//


// Moodle is distributed in the hope that it will be useful,


// but WITHOUT ANY WARRANTY; without even the implied warranty of


// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the


// GNU General Public License for more details.


//


// You should have received a copy of the GNU General Public License


// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**


 * leeloolxpcert module capability definition


 *


 * @package    mod_leeloolxpcert


 * @copyright  2013 Mark Nelson <markn@moodle.com>


 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later


 */


defined('MOODLE_INTERNAL') || die();


$capabilities = array(


    'mod/leeloolxpcert:addinstance' => array(


        'riskbitmask' => RISK_XSS,


        'captype' => 'write',


        'contextlevel' => CONTEXT_COURSE,


        'archetypes' => array(


            'editingteacher' => CAP_ALLOW,


            'manager' => CAP_ALLOW


        ),


        'clonepermissionsfrom' => 'moodle/course:manageactivities'


    ),


    'mod/leeloolxpcert:view' => array(


        'captype' => 'read',


        'contextlevel' => CONTEXT_MODULE,


        'archetypes' => array(


            'student' => CAP_ALLOW,


            'teacher' => CAP_ALLOW,


            'editingteacher' => CAP_ALLOW,


            'manager' => CAP_ALLOW


        )


    ),


    'mod/leeloolxpcert:manage' => array(


        'captype' => 'write',


        'contextlevel' => CONTEXT_MODULE,


        'archetypes' => array(


            'teacher' => CAP_ALLOW,


            'editingteacher' => CAP_ALLOW,


            'manager' => CAP_ALLOW


        )


    ),


    'mod/leeloolxpcert:receiveissue' => array(


        'captype' => 'read',


        'contextlevel' => CONTEXT_MODULE,


        'archetypes' => array(


            'student' => CAP_ALLOW


        )


    ),


    'mod/leeloolxpcert:viewreport' => array(


        'captype' => 'read',


        'contextlevel' => CONTEXT_MODULE,


        'archetypes' => array(


            'teacher' => CAP_ALLOW,


            'editingteacher' => CAP_ALLOW,


            'manager' => CAP_ALLOW


        )


    ),


    'mod/leeloolxpcert:viewallcertificates' => array(


        'captype' => 'read',


        'contextlevel' => CONTEXT_SYSTEM,


        'archetypes' => array(


            'manager' => CAP_ALLOW


        )


    ),


    'mod/leeloolxpcert:verifycertificate' => array(


        'captype' => 'read',


        'contextlevel' => CONTEXT_MODULE,


        'archetypes' => array(


            'teacher' => CAP_ALLOW,


            'editingteacher' => CAP_ALLOW,


            'manager' => CAP_ALLOW


        )


    ),


    'mod/leeloolxpcert:verifyallcertificates' => array(


        'captype' => 'read',


        'contextlevel' => CONTEXT_SYSTEM,


        'archetypes' => array(


            'manager' => CAP_ALLOW


        )


    ),


);
