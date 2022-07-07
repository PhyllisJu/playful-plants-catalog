-- Source: (original work) Phyllis Ju --

-- CREATE TABLE users --
CREATE TABLE users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL
);

-- psw: monkey
INSERT INTO
  users (id, name, username, password)
VALUES
  (1, "phyllis", "kj234", "$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.");

-- CREATE TABLE sessions --
CREATE TABLE sessions (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id)
);

-- CREATE TABLE entries --
CREATE TABLE entries (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  plant_id TEXT NOT NULL UNIQUE,
  collo_name TEXT NOT NULL,
  genus_name TEXT NOT NULL,
  nooks INTEGER,
  loose INTEGER,
  climb INTEGER,
  maze INTEGER,
  evocative INTEGER,
  file_name TEXT,
  file_ext TEXT
);

-- entries initial seed data --
INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (1, 'FL_50', 'Garden heliotrope', 'Valeriana officinalis', 0, 0, 0, 0, 1, '1', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (2, 'SH_18', 'Haskap Honeyberry', 'Lonicera caerulea', 0, 1, 0, 0, 1, '2', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (3, 'FE_02', 'Swamp Milkweed', 'Asclepias incanata', 0, 1, 0, 0, 0, '3', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (4, 'FL_19', 'Common Sage', 'Salvia officinalis', 0, 0, 0, 0, 0, '4', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (5, 'FL_14-W', 'American White Water Lily', 'Nymphaea odorata', 0, 1, 0, 0, 1, '5', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (6, 'GR_12', 'Thyme', 'Thymus serpyllum', 0, 1, 0, 0, 1, '6', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (7, 'GR_10', "Sedum 'Fuzzy Wuzzy'", "Sedum dasyphyllum 'Fuzzy Wuzzy'", 0, 0, 0, 0, 1, '7', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (8, 'SH_35', 'Huckleberry (Deerberry)', 'Vaccinium stamineum', 0, 1, 0, 0, 1, '8', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (9, 'TR_09', 'Colorado Blue Spruce', "Picea pungens 'Glauca'", 1, 1, 0, 1, 1, '9', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (10, 'SH_02', 'Autumn Brilliance Serviceberry (Shadbush, juneberry)', 'Amelanchier grandiflora', 0, 1, 1, 0, 1, '10', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (11, 'FL_08', 'Green-headed Coneflower', 'Rudbeckia lacinata', 0, 1, 0, 0, 1, '11', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (12, 'GR_24', 'Creeping Charlie', 'Glechoma hederacea', 1, 1, 0, 0, 1, '12', 'jpg');

INSERT INTO
  entries (id, plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext)
VALUES
  (13, 'SH_24', 'French (Common) Lilac?', 'Syringa vulgaris?', 1, 1, 0, 0, 0, '13', 'jpg');

-- CREATE TABLE tags --
CREATE TABLE tags (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  tag_name TEXT NOT NULL
);

INSERT INTO
  tags (id, tag_name)
VALUES
  (1, "Constructive");

INSERT INTO
  tags (id, tag_name)
VALUES
  (2, "Sensory");

INSERT INTO
  tags (id, tag_name)
VALUES
  (3, "Physical");

INSERT INTO
  tags (id, tag_name)
VALUES
  (4, "Imaginative");

INSERT INTO
  tags (id, tag_name)
VALUES
  (5, "Restorative");

INSERT INTO
  tags (id, tag_name)
VALUES
  (6, "Expressive");

INSERT INTO
  tags (id, tag_name)
VALUES
  (7, "Rules");

INSERT INTO
  tags (id, tag_name)
VALUES
  (8, "Bio");

INSERT INTO
  tags (id, tag_name)
VALUES
  (9, "Shrub");

INSERT INTO
  tags (id, tag_name)
VALUES
  (10, "Grass");

INSERT INTO
  tags (id, tag_name)
VALUES
  (11, "Vine");

INSERT INTO
  tags (id, tag_name)
VALUES
  (12, "Tree");

INSERT INTO
  tags (id, tag_name)
VALUES
  (13, "Flower");

INSERT INTO
  tags (id, tag_name)
VALUES
  (14, "Groundcovers");

INSERT INTO
  tags (id, tag_name)
VALUES
  (15, "Other");

-- CREATE TABLE entry_tags --
CREATE TABLE entry_tags (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  entry_id INTEGER NOT NULL,
  tag_id INTEGER NOT NULL,
  FOREIGN KEY (entry_id) REFERENCES entries(id),
  FOREIGN KEY (tag_id) REFERENCES tags(id)
);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (1, 1, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (2, 1, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (3, 1, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (4, 1, 13);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (5, 2, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (6, 2, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (7, 2, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (8, 2, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (9, 2, 9);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (10, 3, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (11, 3, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (12, 3, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (13, 3, 15);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (14, 4, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (15, 4, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (16, 4, 13);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (17, 5, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (18, 5, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (19, 5, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (20, 5, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (21, 5, 13);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (22, 6, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (23, 6, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (24, 6, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (25, 6, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (26, 6, 14);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (27, 7, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (28, 7, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (29, 7, 14);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (30, 8, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (31, 8, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (32, 8, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (33, 8, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (34, 8, 9);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (35, 9, 1);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (36, 9, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (37, 9, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (38, 9, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (39, 9, 5);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (40, 9, 7);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (41, 9, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (42, 9, 12);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (43, 10, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (44, 10, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (45, 10, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (46, 10, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (47, 10, 9);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (48, 11, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (49, 11, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (50, 11, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (51, 11, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (52, 11, 13);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (53, 12, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (54, 12, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (55, 12, 4);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (56, 12, 5);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (57, 12, 8);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (58, 12, 14);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (59, 13, 2);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (60, 13, 3);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (61, 13, 5);

INSERT INTO
  entry_tags (id, entry_id, tag_id)
VALUES
  (62, 13, 9);
