# steam_ish

# requête de suppression des doublons en BDD 
DELETE FROM libraries
WHERE libraries.id IN (
    SELECT libraries.id
    FROM libraries
    GROUP BY game_id, account_id
    HAVING COUNT(*) > 1
)
