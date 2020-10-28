<?php
declare(strict_types=1);
namespace QuestPlugin;

use pocketmine\event\Listener;
use QuestPlugin\quest\Quest;

abstract class MultiQuest extends Quest {

	public function __construct($name, $player, $quests, $plugin, $rewardCommand) {
        $this->rewardCommand = $rewardCommand;
        $this->quests = $quests;
        $this->index = 0;
        foreach($quests as $quest) {
            $quest->setMultiQuest($this);
        }
        parent::__construct($name,0,count($quests),$player, $plugin);
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
    public function taskCompleted() {
        if($this->index < count($this->quests)) {
            $this->index++;
            $this->quests[$this->index]->enableMulti();
        }
    }

    

}