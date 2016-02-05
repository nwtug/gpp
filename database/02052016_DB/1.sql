
INSERT INTO `queries` (`id`, `code`, `details`) VALUES
(164, 'search_active_provider_list', 'SELECT O.id AS provider_id, O.name, O.name AS provider \r\nFROM organizations O LEFT JOIN users U ON (O._owner_user_id=U.id) LEFT JOIN permission_groups G ON (U._permission_group_id=G.id) \r\n\r\nWHERE G.type = ''provider'' AND O.status = ''active'' AND O.name LIKE ''%_PHRASE_%'' _LIMIT_TEXT_');
