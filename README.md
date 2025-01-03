# Scoreboards-API
Plugin By NATHA

*Scoreboard API*

The Scoreboard API is a tool that allows developers to create and manage custom scoreboards for their players on a Minecraft server. This API provides methods for creating, removing, adding, and updating lines on a scoreboard for a specific player.

*Installation*

To use the Scoreboard API, you need to add the `ScoreboardAPI.php` file to your project and load it on your Minecraft server.

*Usage*

The Scoreboard API provides the following methods:

*`createScoreboard(Player $player, string $displayName, int $sortOrder = 0, string $displaySlot = "sidebar")`*

Creates a new scoreboard for the specified player.

- `$player`: The player for whom the scoreboard will be created.
- `$displayName`: The name that will be displayed on the scoreboard.
- `$sortOrder`: The order in which the lines will be displayed on the scoreboard (optional, default 0).
- `$displaySlot`: The slot in which the scoreboard will be displayed (optional, default "sidebar").

*`removeScoreboard(Player $player)`*

Removes the scoreboard for the specified player.

- `$player`: The player for whom the scoreboard will be removed.

*`addLine(Player $player, string $line, int $score)`*

Adds a new line to the scoreboard for the specified player.

- `$player`: The player for whom the line will be added.
- `$line`: The text that will be displayed on the line.
- `$score`: The score that will be displayed on the line.

*`updateLine(Player $player, string $line, int $score)`*

Updates a line on the scoreboard for the specified player.

- `$player`: The player for whom the line will be updated.
- `$line`: The text that will be displayed on the line.
- `$score`: The new score that will be displayed on the line.

*Example Usage*

```
use ScoreboardAPI\ScoreboardAPI;

// Create a new scoreboard for the player
$scoreboardAPI = ScoreboardAPI::getInstance();
$scoreboardAPI->createScoreboard($player, "My Scoreboard", 0, "sidebar");

// Add a new line to the scoreboard
$scoreboardAPI->addLine($player, "Line 1", 10);

// Update the line on the scoreboard
$scoreboardAPI->updateLine($player, "Line 1", 15);

// Remove the scoreboard for the player
$scoreboardAPI->removeScoreboard($player);
```

We hope this API is helpful for creating custom scoreboards for your players. If you have any questions or need further assistance, don't hesitate to ask!
