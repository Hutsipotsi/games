ALTER TABLE konsolit
ADD konsolityyppi VARCHAR(15)
AFTER malli;

UPDATE konsolit
SET konsolityyppi = 'Pelikonsoli'
WHERE malli = 'GameCube' OR malli = 'SNES'