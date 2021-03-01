<?php


namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class LibraryExtension.php
 *
 * @author Kevin Tourret
 */
class LibraryExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('game_installed', [$this, 'getGameInstalled']),
            new TwigFilter('sec_to_time', [$this, 'getSecToTime']),
        ];
    }

    /**
     * @param bool $isInstalled
     * @return string
     */
    public function getGameInstalled(bool $isInstalled): string
    {
        $installed = 'Oui';
        if (!$isInstalled) $installed = 'Non';
        return $installed;
    }

    /**
     * @param int $seconds
     * @return string
     */
    public function getSecToTime(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $seconds = $seconds - 3600 * $hours;
        $mins = floor($seconds / 60);
        $seconds = $seconds - 60 * $mins;
        return $hours . 'h ' . $mins . 'm ' . $seconds . '\'';
    }
}
