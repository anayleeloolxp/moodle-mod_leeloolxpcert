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
 * This file contains the leeloolxpcert element background image's core interaction API.
 *
 * @package    leeloolxpcertelement_bgimage
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace leeloolxpcertelement_bgimage;

defined('MOODLE_INTERNAL') || die();
/**
 * The leeloolxpcert element background image's core interaction API.
 *
 * @package    leeloolxpcertelement_bgimage
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class element extends \leeloolxpcertelement_image\element {
    /**
     * This function renders the form elements when adding a leeloolxpcert element.
     *
     * @param \MoodleQuickForm $mform the edit_form instance
     */
    public function render_form_elements($mform) {
        $mform->addElement('select', 'fileid', get_string('image', 'leeloolxpcertelement_image'), self::get_images());
        $mform->addElement(
            'filemanager',
            'leeloolxpcertimage',
            get_string('uploadimage', 'leeloolxpcert'),
            '',
            $this->filemanageroptions
        );
    }
    /**
     * Performs validation on the element values.
     *
     * @param array $data the submitted data
     * @param array $files the submitted files
     * @return array the validation errors
     */
    public function validate_form_elements($data, $files) {
        // Array to return the errors.
        return array();
    }
    /**
     * Handles rendering the element on the pdf.
     *
     * @param \pdf $pdf the pdf object
     * @param bool $preview true if it is a preview, false otherwise
     * @param \stdClass $user the user we are rendering this for
     */
    public function render($pdf, $preview, $user) {
        // If there is no element data, we have nothing to display.
        if (empty($this->get_data())) {
            return;
        }
        $imageinfo = json_decode($this->get_data());
        $imageinfo->width = 0;
        $imageinfo->height = 0;
        $imageinfo->filearea = 'image';
        $imageinfo->contextid = 0;
        $img = file_get_contents($imageinfo->image);
        $pdf->Image('@' . $img, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight());
    }
    /**
     * Render the element in html.
     *
     * This function is used to render the element when we are using the
     * drag and drop interface to position it.
     *
     * @return string the html
     */
    public function render_html() {
        global $DB;
        // If there is no element data, we have nothing to display.
        if (empty($this->get_data())) {
            return '';
        }
        $imageinfo = json_decode($this->get_data());
        // If there is no file, we have nothing to display.
        if (empty($imageinfo->filename)) {
            return '';
        }
        if ($file = $this->get_file()) {
            $url = \moodle_url::make_pluginfile_url(
                $file->get_contextid(),
                'mod_leeloolxpcert',
                'image',
                $file->get_itemid(),
                $file->get_filepath(),
                $file->get_filename()
            );
            // Get the page we are rendering this on.
            $page = $DB->get_record('leeloolxpcert_pages', array('id' => $this->get_pageid()), '*', MUST_EXIST);
            // Set the image to the size of the page.
            $style = 'width: ' . $page->width . 'mm; height: ' . $page->height . 'mm';
            return \html_writer::tag('img', '', array('src' => $url, 'style' => $style));
        }
    }
}
