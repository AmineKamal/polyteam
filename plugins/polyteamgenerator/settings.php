<?php
// This file is part of Moodle - http://moodle.org/
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
 * Plugin administration pages are defined here.
 *
 * @package     block_polyteamgenerator
 * @category    admin
 * @copyright   2020 Amine Kamal m.amine.kamal@gmail.com
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
   $settings->add(new admin_setting_configtext('block_polyteamgenerator_url', 'Backend Url', 'Root Url of the backend server', 'https://polyteam-backend-staging.herokuapp.com/', PARAM_TEXT));
   $settings->add(new admin_setting_configtext('block_polyteamgenerator_section_regex', 'Sections Regex', 'Regex used to differenciate section groupings from other groupings', '/^[A-Z]{3}[0-9]{4}([A-Z]{1})?_[0-9]{2}[LC]$/', PARAM_TEXT));
}
