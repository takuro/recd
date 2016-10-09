CREATE TABLE member_rates (
  id INTEGER PRIMARY KEY AUTOINCREMENT, 
  rater_id INTEGER,
  members_id INTEGER,
  rate INTEGER,
  created_at TEXT
);
create index idx_member_rates_rater_id on member_rates(rater_id);
create index idx_member_rates_member_id on member_rates(members_id);
