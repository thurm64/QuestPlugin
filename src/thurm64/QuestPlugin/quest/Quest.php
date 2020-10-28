<?php
declare(strict_types=1);
namespace QuestPlugin;

use pocketmine\event\Listener;


abstract class Quest implements Listener{

	public function __construct($name, $min, $max, $player, $plugin) {
        $this->name = $name;
        $this->plugin = $plugin;
        $this->min = $min;
        $this->max = $max;
        $this->completed = $min;
        $this->player = $player;
        $this->isComplete = false;
        $this->onStarted();
        $this->multi = null;
    }
    public function setMultiQuest($q) {
        $this->multi = $q;
        $this->isEnabled = false;
        
    }
    public function enableMulti() {
        $this->isEnabled = true;
    }
    abstract public function onStarted();
    abstract public function onCompleted(); 
    public function showCompletion() {
        if($this->multi == null || $this->isEnabled) {

        }
        //send bossbar with scoreboard here
    }
    public function finish() {
        if($this->multi == null || $this->isEnabled) {
            $this->multi->taskCompleted();
        }
        //clear and clean up
    }
    public function removeCompletion($cmp) {
        if($this->multi != null) {
            $this->completed -= $cmp;
            $this->showCompletion();
        }
    }
    public function addCompletion($cmp) {
        if($this->multi == null || $this->isEnabled) {

        
            $this->completed -= $cmp;
            if($cmp <= $this->max) {
                $this->onCompleted();
            }
            $this->showCompletion();
        }
    }
}