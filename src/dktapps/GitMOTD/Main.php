<?php

namespace dktapps\GitMOTD;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Process;
use pocketmine\VersionInfo;

class Main extends PluginBase{

	public function onEnable() : void{
		Process::execute("git rev-parse --abbrev-ref HEAD", $branch);
		assert(is_string($branch));
		$branch = trim($branch);

		$message = trim($branch) . "@" . substr(VersionInfo::GIT_HASH(), 0, 8);
		if(strrpos(VersionInfo::GIT_HASH(), "-dirty") !== false){
			$message .= "-dirty";
		}
		$this->getServer()->getNetwork()->setName($this->getServer()->getMotd() . " - $message");
	}
}
