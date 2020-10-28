<?php
declare(strict_types=1);
namespace QuestPlugin;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockPlaceEvent;
use QuestPlugin\quest\Quest;

class PlaceBlockQuest extends Quest {
    public function __construct($name, $max, $player, $plugin, $blockType, $rewardCommand) {
        $this->block = $blockType;
        $this->rewardCommand = $rewardCommand;
        parent::__construct($name,0,$max,$player, $plugin);
    }
    public function onStarted()
    {
        $this->showCompletion();
    }
    public function onCompleted()
    {
        //give player stuff here
        $this->finish();
    }
    public function onBlockBreak(BlockPlaceEvent $event) {
        if(!$event->isCancelled() && $event->getPlayer()->getName() == $this->player->getName()) {
            if($event->getBlock()->getId() == $this->block) {
                $event->addCompletion(1);
            }
        }
    } 
    
}