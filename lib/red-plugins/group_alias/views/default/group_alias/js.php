<?php
/**
 *
 * @package        Lorea
 * @subpackage     GroupAlias
 *
 * Copyright 2011-2013 Lorea Faeries <federation@lorea.org>
 *
 * This file is part of the GroupAlias plugin for Elgg.
 *
 * GroupAlias is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License
 * as published by the Free Software Foundation, either version 3 of
 * the License, or (at your option) any later version.
 *
 * GroupAlias is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */
?>
$(function(){
	$('input.elgg-input-text[name="name"]').keyup(function(){
		$('input.elgg-input-text[name="alias"][disabled!="disabled"]').val(function(title){
			return title.replace(/[^\w ]/g, "")
							.replace(/^\s+/g,'').replace(/\s+$/g,'') //trim
							.replace(/ /g, "_")
							.replace(/__/g, "_")
							.toLowerCase();
		}($(this).val()));
	});
});
