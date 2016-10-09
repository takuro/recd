CREATE TABLE members (
  id INTEGER PRIMARY KEY AUTOINCREMENT, 
  created_user_id INTEGER,
  name TEXT,
  description TEXT,
  created_at TEXT
);

create index idx_members_created_user_id on members(created_user_id);

