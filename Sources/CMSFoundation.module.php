<?php
class CMSFoundation extends CMSModule

{

	function GetName()

	{

		return 'CMSFoundation';

	}

	function GetFriendlyName()

	{

		return "CMS Foundation";

	}

	function GetVersion()

	{

		return '1.1';

	}

	function MinimumCMSVersion()

	{

		return '1.7';

	}

	function GetHelp()

	{

		return $this->Lang('help');

	}

	function GetAuthor()

	{

		return 'Nicolas Grillet';

	}

	function GetAuthorEmail()

	{

		return 'n.grillet01@gmail.com';

	}

	function GetChangeLog()

	{

		return $this->Lang('changelog');

	}

	function IsPluginModule()

	{

		return true;

	}

	function HasAdmin()

	{

		return true;

	}

	function GetAdminSection()

	{

		return 'extensions';

	}

	function GetAdminDescription()

	{

		return $this->Lang('moddescription');

	}

	function VisibleToAdminUser() 

	{

		return ($this->CheckPermission('View CMSFoundation') || $this->CheckPermission('Administrate CMSFoundation'));

	}	

	function GetDependencies()

	{

	return array('CGExtensions'=>'1.24',
				 'JQueryTools'=>'1.0.11');
	}

	function Install()

	{
		$db = $this->GetDb();
		$query = 'INSERT INTO '.cms_db_prefix().'module_templates (module_name, template_name, content, create_date, modified_date) VALUES (?,?,?,?,?)';
	    $dbr = $db->Execute($query, array("MenuManager", "responsive_menu", "{assign var=\"number_of_levels\" value=10000}
{if isset($menuparams.number_of_levels)}
  {assign var=\"number_of_levels\" value=$menuparams.number_of_levels}
{/if}
<div class=\"row\">
<div class=\"twelve columns\">
{if $count > 0}
<div class=\"top-bar\">
<ul>
{foreach from=$nodelist item=node}
	{if $node->children_exist == true or $node->parent == true}
		{if $node->depth < $node->prevdepth}
			</ul></li>
		{/if}
		<li class=\"has-dropdown\">
			<a href=\"{if $node->url!=''}{$node->url}{else}#{/if}\">{$node->menutext}</a>
			<ul class=\"dropdown\">
	{else}
		{if $node->type =='sectionheader'}
                     <li><label>{$node->menutext}</label></li>
		{elseif $node->type =='separator'}
                     <li class=\"divider\"></li>
                {else}
                     <li><a href=\"{if $node->url!=''}{$node->url}{else}#{/if}\">{$node->menutext}</a></li>
                {/if}
	{/if}
{/foreach}
</ul>
</div>
{/if}
</div>
</div>", trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));
		$this->CreatePermission('CMSFoundation Admin', 'Manage CMSFoundation');
		$this->CreatePermission('CMSFoundation View', 'View CMSFoundation');

	}

	function SetParameters() 

	{

		$this->RestrictUnknownParams();

		$this->RegisterModulePlugin();

	}

	function InstallPostMessage()

	{

		return $this->Lang('postinstall');

	}

	function Uninstall()

	{
		$this->RemovePermission('CMSFoundation Admin');
		$this->RemovePermission('CMSFoundation View');

	}

	function UninstallPreMessage()

	{

		return $this->Lang('uninstall_confirm');

	}

	function UninstallPostMessage()

	{

		return $this->Lang('postuninstall');

	}

}

?>