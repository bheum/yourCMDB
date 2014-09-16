<?php
/********************************************************************
* This file is part of yourCMDB.
*
* Copyright 2013-2014 Michael Batz
*
*
* yourCMDB is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* yourCMDB is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with yourCMDB.  If not, see <http://www.gnu.org/licenses/>.
*
*********************************************************************/

/**
* WebUI element: quicksearch
* @author Michael Batz <michael@yourcmdb.org>
*/

	//get data
	$objectTypes = $config->getObjectTypeConfig()->getObjectTypeGroups();
	//get possibly set parameters
        $paramSearchString = getHttpGetVar("searchstring", "");
        $paramType = getHttpGetVar("type", "");
        $paramTypeGroup = getHttpGetVar("typegroup", "");
        $paramActiveOnly = getHttpGetVar("activeonly", "1");


	echo "<div class=\"box\">";
	echo "<h1>";
	echo gettext("Quicksearch");
	echo "</h1>";

	//Search by AssetID
	echo "<form action=\"object.php\" method=\"get\" accept-charset=\"UTF-8\">";
	echo "<p>";
	echo gettext("Asset ID:");
	echo "<br />";
	echo "<input type=\"text\" name=\"id\" />";
	echo "<input type=\"hidden\" name=\"action\" value=\"show\" />";
	echo "<input type=\"submit\" value=\"".gettext("Go")."\" />";
	echo "</p>";
	echo "</form>";

	//Search by field value
	echo "<form action=\"search.php\" method=\"get\" accept-charset=\"UTF-8\">";
	echo "<fieldset>";
	echo "<p>";
	echo gettext("Searchstring:");
	echo "<br />";
	echo "<input id=\"quicksearch\" type=\"text\" value=\"$paramSearchString\" name=\"searchstring\" onfocus=\"javascript:showSearchBar('#quicksearchoptions')\"/>";
	echo "</p>";
	echo "</fieldset>";
	//search options
	echo "<fieldset class=\"searchoptions\" id=\"quicksearchoptions\">";
	echo "<table>";
	//active objects
	echo "<tr>";
	echo "<td>".gettext("show inactive objects")."</td>";
	if($paramActiveOnly == "1")
	{
		echo "<td><input type=\"checkbox\" name=\"activeonly\" value=\"0\"/></td>";
	}
	else
	{
		echo "<td><input type=\"checkbox\" name=\"activeonly\" value=\"0\" checked=\"checked\" /></td>";
	}
	echo "</tr>";
	//objecttype group
	echo "<tr>";
	echo "<td>".gettext("objecttype group")."</td>";
	echo "<td><select name=\"typegroup\">";
	echo "<option></option>";
        foreach(array_keys($objectTypes) as $group)
        {
		if($paramTypeGroup == $group)
		{
                	echo "<option selected=\"selected\">$group</option>";
		}
		else
		{
                	echo "<option>$group</option>";
		}
        }
        echo "</select></td>";
	echo "</tr>";
	//objecttype
	echo "<tr>";
	echo "<td>".gettext("Type:")."</td>";
	echo "<td><select name=\"type\">";
	echo "<option></option>";
	foreach(array_keys($objectTypes) as $group)
	{
		echo "<optgroup label=\"$group\">";
		foreach($objectTypes[$group] as $type)
		{
			if($paramType == $type)
			{
				echo "<option selected=\"selected\">$type</option>";
			}
			else
			{
				echo "<option>$type</option>";
			}
		}
		echo "</optgroup>";
	}
	echo "</select></td>";
	echo "</tr>";
	//submit button
	echo "<tr>";
	echo "<td colspan=\"2\"><input type=\"submit\" value=\"".gettext("Go")."\" /></td>";
	echo "</tr>";
	echo "</table>";
	echo "</fieldset>";
	echo "</form>";
	echo "</div>";

?>
