
/** sessions indexes **/
db.getCollection("sessions").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** users indexes **/
db.getCollection("users").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** sessions records **/
db.getCollection("sessions").insert({
  "_id": ObjectId("59381591d5d64236d5604249"),
  "session_id": "b96idu3vjscrguqaei2duok8f4",
  "data": "user_id|s:24:\"593815efd893980011000029\";roles|i:11;",
  "timedout_at": NumberInt(1496854191),
  "expired_at": NumberInt(1496883761)
});

/** system.indexes records **/
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "name": "_id_",
  "ns": "travel.sessions"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "name": "_id_",
  "ns": "travel.users"
});

/** users records **/
db.getCollection("users").insert({
  "_id": ObjectId("593815efd893980011000029"),
  "username": "admin",
  "password": "ec705f9abe736346fc04409dc85c79d8",
  "roles": NumberInt(11),
  "hinhanh": "",
  "logs": [
    {
      "in": ISODate("2017-06-07T15:04:20.0Z")
    }
  ],
  "hoten": "Phan Minh Trung"
});
