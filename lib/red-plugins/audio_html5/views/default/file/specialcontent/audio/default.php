<?php
/**
 * Audio HTML5 -- File view override
 *
 * @package        Lorea
 * @subpackage     AudioHTML5
 *
 * Copyright 2011-2013 Lorea Faeries <federation@lorea.org>
 *
 * This file is part of the AudioHTML5 plugin for Elgg.
 *
 * AudioHTML5 is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * AudioHTML5 is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

echo elgg_view('audio_html5/audioplayer', array('file_guid' => $vars['entity']->getGUID()));
