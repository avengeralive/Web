SELECT m.*, 
	(SELECT json_agg(x.*) 
	FROM (
		SELECT mg.*, 
			(SELECT json_agg(t.*) 
			FROM (
				SELECT g1.* 
				FROM menu_goods g1, menu mmmm 
				WHERE g1.group_ID = mg.ID AND mg.AND (lower(g1.name) LIKE '%${search:value}%' OR lower(mg.name) LIKE '%${search:value}%') 
				ORDER BY g1.ordering) t) 
		as goods, 
			(SELECT json_agg(y.*) 
			FROM 
				(SELECT msg.*, 
					(SELECT json_agg(z.*) 
					FROM (
						SELECT g.* 
						FROM menu_goods g, menu_groups msggg, menu mmm 
						WHERE g.group_ID = msg.ID AND msg.group_ID = msggg.ID AND msggg.menu_ID = mmm.ID AND (lower(mmm.name) LIKE '%${search:value}%' OR lower(g.name) LIKE '%${search:value}%' OR lower(msg.name) LIKE '%${search:value}%' OR lower(msggg.name) LIKE '%${search:value}%') 
						ORDER BY g.ordering) z) 
			as goods 
			FROM menu_groups msg 
			WHERE msg.menu_ID = m.ID AND msg.group_ID = mg.ID 
			ORDER BY msg.ordering) y) 
		as subgroups 
	FROM menu_groups mg 
	WHERE mg.menu_ID = m.ID AND mg.group_ID = 0 
	ORDER BY mg.ordering) x) 
as groups 
FROM menu m 
WHERE m.place_ID = ${place_id}