<?php
namespace natha\scoreboards;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;

class ScoreboardAPI extends PluginBase {

    private static $scoreboards = [];
    public static $plugin;
    
    public function onEnable() : void {
        self::$plugin = $this;
    }

    public static function getInstance() {
        return self::$plugin;
    }

    /**
     * Creates a new scoreboard for the specified player.
     *
     * @param Player $player The player who will receive the scoreboard.
     * @param string $displayName The display name of the scoreboard.
     * @param int $sortOrder The sort order of the scoreboard.
     * @param string $displaySlot The display slot of the scoreboard.
     */
    public function createScoreboard(Player $player, string $displayName, int $sortOrder = 0, string $displaySlot = "sidebar") {
        if (isset(self::$scoreboards[$player->getName()])) {
            $this->removeScoreboard($player);
        }
        $packet = new SetDisplayObjectivePacket();
        $packet->displaySlot = $displaySlot;
        $packet->objectiveName = "objective";
        $packet->displayName = $displayName;
        $packet->criteriaName = "dummy";
        $packet->sortOrder = $sortOrder;
        $player->getNetworkSession()->sendDataPacket($packet);
        self::$scoreboards[$player->getName()] = $player->getName();
    }

    /**
     * Removes the scoreboard from the specified player.
     *
     * @param Player $player The player who will lose the scoreboard.
     */
    public function removeScoreboard(Player $player) {
        $packet = new RemoveObjectivePacket();
        $packet->objectiveName = "objective";
        $player->getNetworkSession()->sendDataPacket($packet);
        unset(self::$scoreboards[$player->getName()]);
    }

    /**
     * Adds a new line to the scoreboard of the specified player.
     *
     * @param Player $player The player who will receive the new line.
     * @param string $line The text of the line.
     * @param int $score The score of the line.
     */
    public function addLine(Player $player, string $line, int $score) {
        $pkline = new ScorePacketEntry();
        $pkline->objectiveName = "objective";
		    $pkline->type = ScorePacketEntry::TYPE_FAKE_PLAYER;
		    $pkline->customName = $line;
		    $pkline->score = $score;
		    $pkline->scoreboardId = $score;
		    $packet = new SetScorePacket();
		    $packet->type = SetScorePacket::TYPE_CHANGE;
		    $packet->entries[] = $pkline;
		    $player->getNetworkSession()->sendDataPacket($packet);
    }

    /**
     * Updates a line in the scoreboard of the specified player.
     *
     * @param Player $player The player who will receive the updated line.
     * @param string $line The text of the line to update.
     * @param int $score The new score of the line.
     */
    public function updateLine(Player $player, string $line, int $score) {
        $this->addLine($player, $line, $score);
    }
}

/**
"This API provides the following methods:

- `createScoreboard(Player $player, string $displayName, int $sortOrder = 0, string $displaySlot = "sidebar")`: Creates a new scoreboard for the specified player.
- `removeScoreboard(Player $player)`: Removes the scoreboard for the specified player.
- `addLine(Player $player, string $line, int $score)`: Adds a new line to the scoreboard for the specified player.
- `updateLine(Player $player, string $line, int $score)`: Updates a line in the scoreboard for the specified player."
**/