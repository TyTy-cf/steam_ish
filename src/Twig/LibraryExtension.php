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
}
