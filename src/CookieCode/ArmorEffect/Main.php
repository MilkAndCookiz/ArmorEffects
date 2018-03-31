<?php
  
namespace CookieCode\ArmorEffect;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\item\Item;
use pocketmine\inventory\PlayerInventory;
use pocketmine\inventory\ArmorInventory;

//Coded by CookieCode.

class Main extends PluginBase implements Listener{

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
  }

  public function onLoad() {
    	$this->getLogger()->info(TF::GREEN . "Loading...");
  }

  public function onArmorChange(EntityArmorChangeEvent $ev){
    $player = $ev->getEntity();
    $Nid = $ev->getNewItem()->getID();
    $Oid = $ev->getOldItem()->getID();

    if($player instanceof Player){
    //Chain Helmet
    if($Nid === 302){
        $effect = Effect::getEffect(16);
        $effect->setVisible(false);
        $effect->setAmplifier(0);
        $effect->setDuration(9999999);
        $player->addEffect($effect);
      
        $effect1 = Effect::getEffect(5);
      $effect1->setVisible(false);
      $effect1->setAmplifier(0);
      $effect1->setDuration(9999999);
      $player->addEffect($effect1);
      
    }elseif($Oid === 302){
      $player->removeEffect(16);
      $player->removeEffect(5);
    }
    
    //Chain Chestplate
    if($Nid === 303){
      $effect = Effect::getEffect(21);
      $effect->setVisible(false);
      $effect->setAmplifier(4);
      $effect->setDuration(9999999);
      $player->addEffect($effect);
      
    }elseif($Oid === 303){
      $player->removeEffect(21);
    }
    
    //Chain Leggings
    if($Nid === 304){
      $effect = Effect::getEffect(11);
      $effect->setVisible(false);
      $effect->setAmplifier(1);
      $effect->setDuration(9999999);
      $player->addEffect($effect);
      
    }elseif($Oid === 304){
      $player->removeEffect(11);
    }
    
    //Chain Boots
    if($Nid === 305){
      $effect = Effect::getEffect(3);
      $effect->setVisible(false);
      $effect->setAmplifier(1);
      $effect->setDuration(9999999);
      $player->addEffect($effect);
      
    }elseif($Oid === 305){
      $player->removeEffect(3);
    }
  }
}
}
