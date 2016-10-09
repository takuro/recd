CREATE TABLE projects (
  id INTEGER PRIMARY KEY AUTOINCREMENT, 
  created_user_id INTEGER,
  name TEXT,
  description TEXT,
  created_at TEXT
);

create index idx_projects_created_user_id on projects(created_user_id);
