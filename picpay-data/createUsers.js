conn = new Mongo();

adm = conn.getDB("admin");
adm.createUser({
    user: "dbaAdmin",
    pwd: "abc123",
    roles: [ { role: "userAdminAnyDatabase", db: "admin" } ]
});

ppu = conn.getDB("picpaydb");
ppu.createUser({
    user: "picpayUser",
    pwd: "picpay123",
    roles: [ { role: "dbOwner", db: "picpaydb" }]
});

ppu.createCollection("naoUsada");
