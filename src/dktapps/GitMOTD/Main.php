<?php

namespace dktapps\GitMOTD;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Utils;

class Main extends PluginBase{

	public function onEnable() : void{
		Utils::execute("git rev-parse --abbrev-ref HEAD", $branch);
		assert(is_string($branch));
		$branch = trim($branch);

		$message = trim($branch) . "@" . substr(\pocketmine\GIT_COMMIT, 0, 8);
		if(strrpos(\pocketmine\GIT_COMMIT, "-dirty") !== false){
			$message .= "-dirty";
		}
		$this->getServer()->getNetwork()->setName($this->getServer()->getMotd() . " - $message");
	}
}
