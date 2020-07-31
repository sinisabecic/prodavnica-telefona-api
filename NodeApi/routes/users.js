const express = require("express");
const router = express.Router();
const User = require("../model/korisnik.model");

router.get("/", async (req, res) => {
  try {
    const users = await User.find();
    res.json(users);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
});

router.get("/:username/:password", async (req, res) => {
  try {
    let postoji = await User.count({
      username: req.params.username,
      password: req.params.password,
    });

    if (postoji < 1) {
      return res.status(204).json({});
    }

    let korisnik = await User.find({
      username: req.params.username,
      password: req.params.password,
    });

    res.status(201).json(korisnik);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
});

router.get("/:id", async (req, res) => {
  try {
    let korisnik = await User.findById(req.params.id);
    if (korisnik == null) {
      return res.status(404).json({ message: "Ne postoji ovaj korisnik" });
    }

    res.status(201).json(korisnik);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
});

router.delete("/:id", async (req, res) => {
  try {
    let korisnik = await User.findById(req.params.id);
    if (korisnik == null) {
      return res.status(404).json({ message: "Ne postoji ovaj korisnik" });
    }

    korisnik.deleteOne();

    res.status(200).json({ message: "Izbrisano." });
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
});

router.post("/", async (req, res) => {
  try {
    let postoji = await User.count({
      username: req.body.username,
    });

    if (postoji > 0) {
      return res.status(200).json({
        message:
          "Korisnik sa email-om " +
          req.body.email +
          " vec postoji. Molimo Vas da unesete neki drugi email.",
      });
    }

    const user = new User({
      name: req.body.name,
      address: req.body.address,
      city: req.body.city,
      country: req.body.country,
      zip: req.body.zip,
      phone: req.body.phone,
      username: req.body.username,
      email: req.body.email,
      password: req.body.password,
      is_admin: req.body.is_admin,
    });

    const newUser = await user.save();
    return res.status(201).json(newUser);
  } catch (err) {
    return res.status(400).json({ message: err.message });
  }
});

router.put("/:id", async (req, res) => {
  try {
    let korisnik = await User.findById(req.params.id);
    if (korisnik == null) {
      return res.status(400).json({ message: "Ne postoji ovaj korisnik" });
    }

    if (req.body.name != null) {
      korisnik.name = req.body.name;
    }
    if (req.body.address != null) {
      korisnik.address = req.body.address;
    }
    if (req.body.city != null) {
      korisnik.city = req.body.city;
    }
    if (req.body.country != null) {
      korisnik.country = req.body.country;
    }
    if (req.body.zip != null) {
      korisnik.zip = req.body.zip;
    }
    if (req.body.phone != null) {
      korisnik.phone = req.body.phone;
    }
    if (req.body.username != null) {
      korisnik.username = req.body.username;
    }
    if (req.body.email != null) {
      korisnik.email = req.body.email;
    }
    if (req.body.password != null) {
      korisnik.password = req.body.password;
    }
    if (req.body.is_admin != null) {
      korisnik.is_admin = req.body.is_admin;
    }

    const updatedKorisnik = await korisnik.save();
    return res.status("201").json({ updatedKorisnik });
  } catch (err) {
    return res.status("500").json({ message: err.message });
  }
});

module.exports = router;
