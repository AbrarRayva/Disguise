<?php

namespace DarkfulRebel\Disguise;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if(strtolower($command->getName()) === "disguise"){
            if($sender instanceof ConsoleCommandSender){
                $sender->sendMessage("You cannot disguise as a Player if you're on Server Console!");
            } elseif($sender instanceof Player){
                if(count($args) === 1){
                    $commandArgs = $args[0];
                    $target = $this->getServer()->getPlayer($commandArgs);
                    if($target instanceof Player){
                        $senderName = $sender->getName();
                        $targetSkin = $target->getSkin();
                        $targetName = $target->getName();
                        $targetDisplayName = $target->getDisplayName();
                        $targetNameTag = $target->getNameTag();
                        
                        $sender->setSkin($targetSkin);
                        $sender->setDisplayName($targetDisplayName);
                        $sender->setNameTag($targetNameTag);
                        $sender->sendMessage("You're now disguised as§6 " . $targetName);
                    } else{
                        $sender->sendMessage("§cPlayer not found!");
                    }

                } else{
                        $sender->sendMessage("Usage: /disguise <playername>");
                    }
            }
        }
        return true;
    }
}