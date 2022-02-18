<?php

declare(strict_types=1);

namespace Nyrok\Panel;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;

class Main extends PluginBase {
    const DEFAULT_LANGUAGE = "eng";
    const DEFAULT_MOTD = "PocketMine-MP Server";
    const DEFAULT_SERVER_NAME = "Your Server";
    const DEFAULT_SERVER_PORT = 19132;
    const DEFAULT_GAMEMODE = 0;
    const DEFAULT_MAX_PLAYERS = 20;
    const DEFAULT_WHITELIST = false;
    const DEFAULT_ENABLE_QUERY = false;
    const DEFAULT_SERVER_PORT_V6 = 19133;
    const DEFAULT_ENABLE_IP_V6 = true;
    const DEFAULT_FORCE_GAMEMODE = false;
    const DEFAULT_HARDCORE = false;
    const DEFAULT_PVP = true;
    const DEFAULT_DIFFICULTY = World::DIFFICULTY_NORMAL;
    const DEFAULT_GENERATOR_SETTINGS = "";
    const DEFAULT_LEVEL_NAME = "world";
    const DEFAULT_LEVEL_SEED = "";
    const DEFAULT_LEVEL_TYPE = "default";
    const DEFAULT_AUTO_SAVE = true;
    const DEFAULT_VIEW_DISTANCE = 8;
    const DEFAULT_XBOX_AUTH = true;

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if($command->getName() === "panel"){
            if($sender instanceof Player and ($sender->hasPermission("panel") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR))){
                if(isset($args[0]) and ($args[0] === "ver" or $args[0] === "version")){
                    $sender->sendMessage("§1- [§9Panel§1] §l§91.0.0 §r§1-\n§3Twitter : §b@Nyrok10\n§eCrédits : §cHiroTeam§f, §bAzurMC");
                }
                else {
                    $this->panel($sender);
                }
            }
        }
        return true;
    }

    public function panel(Player $player): void {
        $lang = $this->getServer()->getConfigGroup()->getConfigString("language", $this::DEFAULT_LANGUAGE);
        $motd = $this->getServer()->getConfigGroup()->getConfigString("motd", $this::DEFAULT_MOTD);
        $name = $this->getServer()->getConfigGroup()->getConfigString("server-name", $this::DEFAULT_SERVER_NAME);
        $port = $this->getServer()->getConfigGroup()->getConfigInt("server-port", $this::DEFAULT_SERVER_PORT);
        $gamemode = $this->getServer()->getConfigGroup()->getConfigInt("gamemode", $this::DEFAULT_GAMEMODE);
        $max_players = $this->getServer()->getConfigGroup()->getConfigInt("max-players", $this::DEFAULT_MAX_PLAYERS);
        $whitelist = $this->getServer()->getConfigGroup()->getConfigBool("white-list", $this::DEFAULT_WHITELIST);
        $query = $this->getServer()->getConfigGroup()->getConfigBool("enable_query", $this::DEFAULT_ENABLE_QUERY);
        $port_v6 = $this->getServer()->getConfigGroup()->getConfigInt("server-portv6", $this::DEFAULT_SERVER_PORT_V6);
        $ip_v6 = $this->getServer()->getConfigGroup()->getConfigBool("enable_ipv6", $this::DEFAULT_ENABLE_IP_V6);
        $force_gamemode = $this->getServer()->getConfigGroup()->getConfigBool("force-gamemode", $this::DEFAULT_FORCE_GAMEMODE);
        $hardcore = $this->getServer()->getConfigGroup()->getConfigBool("hardcore", $this::DEFAULT_HARDCORE);
        $pvp = $this->getServer()->getConfigGroup()->getConfigBool("white-list", $this::DEFAULT_PVP);
        $difficulty = $this->getServer()->getConfigGroup()->getConfigInt("difficulty", $this::DEFAULT_DIFFICULTY);
        $generator_settings = $this->getServer()->getConfigGroup()->getConfigString("generator-settings", $this::DEFAULT_GENERATOR_SETTINGS);
        $level_name = $this->getServer()->getConfigGroup()->getConfigString("level-name", $this::DEFAULT_LEVEL_NAME);
        $level_seed = $this->getServer()->getConfigGroup()->getConfigString("level-seed", $this::DEFAULT_LEVEL_SEED);
        $level_type = $this->getServer()->getConfigGroup()->getConfigString("level-type", $this::DEFAULT_LEVEL_TYPE);
        $autosave = $this->getServer()->getConfigGroup()->getConfigBool("auto-save", $this::DEFAULT_AUTO_SAVE);
        $view_distance = $this->getServer()->getConfigGroup()->getConfigInt("view-distance", $this::DEFAULT_VIEW_DISTANCE);
        $xbox = $this->getServer()->getConfigGroup()->getConfigBool("xbox-auth", $this::DEFAULT_XBOX_AUTH);

        $form = new CustomForm(function ($player, $data){
            if($data !== null){
                $values = array_values($data);
                $this->getServer()->getConfigGroup()->setConfigString("language", (string)$values[0] ?: $this::DEFAULT_LANGUAGE);
                $this->getServer()->getConfigGroup()->setConfigString("motd", (string)$values[1] ?: $this::DEFAULT_MOTD);
                $this->getServer()->getConfigGroup()->setConfigString("server-name", (string)$values[2] ?: $this::DEFAULT_SERVER_NAME);
                $this->getServer()->getConfigGroup()->setConfigInt("server-port", (int)$values[3] ?: $this::DEFAULT_SERVER_PORT);
                $this->getServer()->getConfigGroup()->setConfigInt("gamemode", (int)$values[4]);
                $this->getServer()->getConfigGroup()->setConfigInt("max-players", (int)$values[5]);
                $this->getServer()->getConfigGroup()->setConfigBool("white-list", (bool)$values[6]);
                $this->getServer()->getConfigGroup()->setConfigBool("enable_query", (bool)$values[7]);
                $this->getServer()->getConfigGroup()->setConfigBool("enable_ipv6", (bool)$values[9]);
                $this->getServer()->getConfigGroup()->setConfigInt("server-portv6", ((int)$values[8] ?: $this::DEFAULT_SERVER_PORT_V6));
                $this->getServer()->getConfigGroup()->setConfigBool("force-gamemode", (bool)$values[10]);
                $this->getServer()->getConfigGroup()->setConfigBool("hardcore", (bool)$values[11]);
                $this->getServer()->getConfigGroup()->setConfigBool("white-list", (bool)$values[12]);
                $this->getServer()->getConfigGroup()->setConfigInt("difficulty", (int)$values[13]);
                $this->getServer()->getConfigGroup()->setConfigString("generator-settings", ((string)$values[14] ?: $this::DEFAULT_GENERATOR_SETTINGS));
                $this->getServer()->getConfigGroup()->setConfigString("level-name", ((string)$values[15] ?: $this::DEFAULT_LEVEL_NAME));
                $this->getServer()->getConfigGroup()->setConfigString("level-seed", ((string)$values[16] ?: $this::DEFAULT_LEVEL_SEED));
                $this->getServer()->getConfigGroup()->setConfigString("level-type", ((string)$values[17] ?: $this::DEFAULT_LEVEL_TYPE));
                $this->getServer()->getConfigGroup()->setConfigBool("auto-save", (bool)$values[18]);
                $this->getServer()->getConfigGroup()->setConfigInt("view-distance", (int)$values[19]);
                $this->getServer()->getConfigGroup()->setConfigBool("xbox-auth", (bool)$values[20]);
                $player->sendMessage("§1[§9Panel§1] §fJ'ai mis à jour les §9paramètres §fdu serveur.");
            }
        });
        $form->addInput("§9Language :§1", "Définir la Langue de votre serveur", $lang);
        $form->addInput("§9Motd :§1", "Définir le Motd de ton serveur", $motd);
        $form->addInput("§9Nom :§1", "Définir le Nom de ton serveur", $name);
        $form->addInput("§9Port :§1", "Définir le Port de ton serveur", (string)$port);
        $form->addSlider("§9Gamemode§1", 0, 3, 1, $gamemode, "Définir le Gamemode de ton serveur");
        $form->addSlider("§9Max Players§1", 0, 1000, 10, $max_players, "Définir les joueurs maximum de ton serveur");
        $form->addToggle("§9White-List", $whitelist, "Définir la White-list de ton serveur");
        $form->addToggle("§9Query", $query, "Activer la Query sur ton serveur");
        $form->addToggle("§9IP V6", $ip_v6, "Activer l'IP V6 sur ton serveur");
        $form->addInput("§9Port V6 :§1", "Définir le Port V6 de ton serveur", (string)$port_v6);
        $form->addToggle("§9Force Gamemode", $force_gamemode, "Activer le Force Gamemode sur ton serveur");
        $form->addToggle("§9Hardcore", $hardcore, "Activer l'Hardcore sur ton serveur");
        $form->addToggle("§9PvP", $pvp, "Activer le PvP sur ton serveur");
        $form->addSlider("§9Difficulty§1", 0, 3, 1, $difficulty, "Définir la Difficulté de ton serveur");
        $form->addInput("§9Generator Settings :§1", "Définir les paramètres de Génération de ton serveur", $generator_settings);
        $form->addInput("§9Level Name :§1", "Définir le Nom du Monde de ton serveur", $level_name);
        $form->addInput("§9Level Seed :§1", "Définir la Seed du Monde de ton serveur", $level_seed);
        $form->addInput("§9Level Type :§1", "Définir le Type de Monde de ton serveur", $level_type);
        $form->addToggle("§9Auto Save", $autosave, "Activer l'Auto Save sur ton serveur");
        $form->addSlider("§9View Distance§1", 5, 50, 1, $view_distance, "Définir la Render Distance de ton serveur");
        $form->addToggle("§9Xbox Auth", $xbox, "Activer l'Xbox Authentification sur ton serveur");
        $form->setTitle("§1[§9Panel§1] §f- §9@Nyrok10 §7on Twitter.");
        $player->sendForm($form);
    }
}
