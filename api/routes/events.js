const express = require('express'),
    router = express.Router(),
    controller = require('../controllers/event.controller');

/* GET events listing. */
router.get('/', function (req, res, next) {
    controller.index().then(body => {
        res.json(body);
    });
});

router.get('/:id', function (req, res, next) {
    controller.show(req.params.id).then(body => {
        res.json(body);
    });
});

module.exports = router;
