# steam_ish

# requête de suppression des doublons en BDD 
DELETE FROM libraries
    WHERE libraries.id IN (
    SELECT 	id
    FROM 	libraries
    GROUP BY account_id, game_id
    HAVING 	COUNT(*) > 1      
) 
