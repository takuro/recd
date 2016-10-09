CREATE TABLE project_member_links (
  id INTEGER PRIMARY KEY AUTOINCREMENT, 
  projects_id INTEGER,
  members_id INTEGER,
  finished TEXT,
  created_at TEXT
);
create index idx_project_member_links_projects_id on project_member_links(projects_id);
create index idx_project_member_links_members_id on project_member_links(members_id);
