# steam_ish

##  requête de suppression des doublons en BDD 

```bash
DELETE FROM libraries
WHERE libraries.id IN (
    SELECT libraries.id
    FROM libraries
    GROUP BY game_id, account_id
    HAVING COUNT(*) > 1
)
```

## Ajout des images au games

```bash
php bin/console games:pictures
```
