# ArmorEffects [2.0]
===================

__An armor effect plugin for Minecraft: Bedrock Edition, now compatible with PocketMine v5.x!__


## Introduction
ArmorEffects is a plugin for **[PocketMine-MP](https://github.com/pmmp/PocketMine-MP)** that grants special effects when players equip specific armor pieces. Originally developed several years ago, the plugin has been fully updated to support the latest version of Minecraft Bedrock Edition by **MilkAndCookiz**.

Contributions and improvements are welcome as the plugin continues to evolve with new features and configuration options.


## Objective
* Provide configurable armor-based effects for players.
* Offer an easily customizable `config.yml` for user-defined effects based on armor type.
* Support the latest PocketMine-MP releases.


## Help & Support
If you encounter any issues, feel free to open a ticket on GitHub! We are happy to help troubleshoot and provide support for setting up and configuring the plugin.

## Installation
1. **[PocketMine-MP](https://github.com/pmmp/PocketMine-MP)** - ArmorEffect works only with the PocketMine server software.
2. **[DevTools](https://github.com/pmmp/PocketMine-DevTools)** - Used to load and develop plugins from folders.

*Important Note:* 
The `master` branch is the officially supported and stable version. Other branches may contain experimental features and should be used with caution.

## Configuration
ArmorEffect is highly customizable, allowing you to configure armor pieces and their corresponding effects via the `config.yml` file. You can specify different effects for helmets, chestplates, leggings, and boots, with adjustable duration and amplifier levels.

Here is an example of the `config.yml` format:

```yaml
armor_effects:
  leather_helmet:
    effect: "speed"
    duration: 60
    amplifier: 1
    visible: true
  iron_chestplate:
    effect: "strength"
    duration: 120
    amplifier: 2
    visible: true
```

The `effect` field corresponds to the available Minecraft effect names (e.g., `speed`, `strength`), and the plugin will apply these effects when players equip the respective armor pieces.

## License
This program is licensed under the **GNU General Public License v3.0** or later. You are free to redistribute and/or modify it under the terms of the GPL.

For more information, please refer to the full license [here](http://www.gnu.org/licenses/gpl-3.0.html).
