<?php

namespace ArmorEffects;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
    private $config;
    private $armorEffects;

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->loadArmorEffects();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::GREEN . "ArmorEffects 2.0 plugin has been enabled!");
    }

    public function onDisable(): void {
        $this->getLogger()->info(TextFormat::RED . "ArmorEffects 2.0 plugin has been disabled!");
    }

    private function loadArmorEffects(): void {
        $this->armorEffects = $this->config->get("armor_effects", []);
    }

    public function onInventoryTransaction(InventoryTransactionEvent $event): void {
        $transaction = $event->getTransaction();
        $player = $transaction->getSource();

        if (!$player instanceof Player) {
            return;
        }

        foreach ($transaction->getActions() as $action) {
            if ($action instanceof SlotChangeAction) {
                $inventory = $action->getInventory();
                if ($inventory === $player->getArmorInventory()) {
                    $newItem = $action->getTargetItem();
                    $oldItem = $action->getSourceItem();
                    $this->handleArmorChange($player, $oldItem, $newItem);
                }
            }
        }
    }

    private function handleArmorChange(Player $player, $oldItem, $newItem): void {
        foreach ($this->armorEffects as $armorType => $effectData) {
            $armorItem = $this->getArmorItem($armorType);
            if ($newItem->equals($armorItem)) {
                $this->addEffect($player, $effectData);
            } elseif ($oldItem->equals($armorItem)) {
                $this->removeEffect($player, $effectData);
            }
        }
    }

    private function getArmorItem(string $armorType) {
        switch (strtolower($armorType)) {
            // Helmets
            case "leather_helmet":
                return VanillaItems::LEATHER_CAP();
            case "chainmail_helmet":
                return VanillaItems::CHAINMAIL_HELMET();
            case "iron_helmet":
                return VanillaItems::IRON_HELMET();
            case "gold_helmet":
                return VanillaItems::GOLDEN_HELMET();
            case "diamond_helmet":
                return VanillaItems::DIAMOND_HELMET();
            // Chestplates
            case "leather_chestplate":
                return VanillaItems::LEATHER_TUNIC();
            case "chainmail_chestplate":
                return VanillaItems::CHAINMAIL_CHESTPLATE();
            case "iron_chestplate":
                return VanillaItems::IRON_CHESTPLATE();
            case "gold_chestplate":
                return VanillaItems::GOLDEN_CHESTPLATE();
            case "diamond_chestplate":
                return VanillaItems::DIAMOND_CHESTPLATE();
            // Leggings
            case "leather_leggings":
                return VanillaItems::LEATHER_PANTS();
            case "chainmail_leggings":
                return VanillaItems::CHAINMAIL_LEGGINGS();
            case "iron_leggings":
                return VanillaItems::IRON_LEGGINGS();
            case "gold_leggings":
                return VanillaItems::GOLDEN_LEGGINGS();
            case "diamond_leggings":
                return VanillaItems::DIAMOND_LEGGINGS();
            // Boots
            case "leather_boots":
                return VanillaItems::LEATHER_BOOTS();
            case "chainmail_boots":
                return VanillaItems::CHAINMAIL_BOOTS();
            case "iron_boots":
                return VanillaItems::IRON_BOOTS();
            case "gold_boots":
                return VanillaItems::GOLDEN_BOOTS();
            case "diamond_boots":
                return VanillaItems::DIAMOND_BOOTS();
            default:
                return null;
        }
    }

    private function addEffect(Player $player, array $effectData): void {
        $effect = $this->getEffectFromString($effectData["effect"]);
        if ($effect !== null) {
            $player->getEffects()->add(new EffectInstance(
                $effect,
                $effectData["duration"] * 20,
                $effectData["amplifier"] - 1,
                $effectData["visible"]
            ));
            $this->getLogger()->info(TextFormat::YELLOW . $effectData["effect"] . " effect added to " . $player->getName());
        }
    }

    private function removeEffect(Player $player, array $effectData): void {
        $effect = $this->getEffectFromString($effectData["effect"]);
        if ($effect !== null) {
            $player->getEffects()->remove($effect);
            $this->getLogger()->info(TextFormat::YELLOW . $effectData["effect"] . " effect removed from " . $player->getName());
        }
    }

    private function getEffectFromString(string $effectName) {
        $effect = null;
        switch (strtolower($effectName)) {
            case "speed":
                $effect = VanillaEffects::SPEED();
                break;
            case "haste":
                $effect = VanillaEffects::HASTE();
                break;
            case "strength":
                $effect = VanillaEffects::STRENGTH();
                break;
            case "jump_boost":
                $effect = VanillaEffects::JUMP_BOOST();
                break;
            case "regeneration":
                $effect = VanillaEffects::REGENERATION();
                break;
            case "resistance":
                $effect = VanillaEffects::RESISTANCE();
                break;
            case "fire_resistance":
                $effect = VanillaEffects::FIRE_RESISTANCE();
                break;
            case "water_breathing":
                $effect = VanillaEffects::WATER_BREATHING();
                break;
            case "invisibility":
                $effect = VanillaEffects::INVISIBILITY();
                break;
            case "night_vision":
                $effect = VanillaEffects::NIGHT_VISION();
                break;
        }
        return $effect;
    }
}