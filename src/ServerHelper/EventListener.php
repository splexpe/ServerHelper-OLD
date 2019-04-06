<?php

namespace ServerHelper;

use ServerHelper\ServerHelper;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\Player;

class EventListener implements Listener {

  private $plugin;
   
  public function __construct(ServerHelper $plugin) {
    $this->plugin = $plugin;
  }

	public function onAttack(EntityDamageByEntityEvent $event) {
		$entity = $event->getEntity();
		$attacker = $event->getDamager();
		if (!$entity instanceof Player) return false;
		if (!$attacker instanceof Player) return false;
		if ($attacker->isFlying()) {
			$attacker->setFlying(false);
			$attacker->setAllowFlight(false);
			$attacker->sendMessage(Main::PREFIX . "§c Flight mode have been disabled due to entering combat");
		}
		if ($entity->isFlying()) {
			$entity->setFlying(false);
			$entity->setAllowFlight(false);
			$entity->sendMessage(Main::PREFIX . "§c Flight mode have been disabled due to entering combat");
		}
		return true;
	}
}
