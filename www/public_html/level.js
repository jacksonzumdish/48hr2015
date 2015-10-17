var level0 = [

        // level1 spacer
        {
            loop: "level1",
        },
        // level1
        {
            loop: "level1-hi",
            boxes: "basic",
        },
        // 2
        {
            boxes: "basic",
            killzones: [ 0.1 ],
        },
        // 3
        {
            loop: "level1-trans",
            boxes: "basic",
            killzones: [ 0.2 ],
        },
        // 4
        {
            loop: "level2",
            boxes: "basic",
            killzones: [ 0.3],
        },
        // 5
        {
            boxes: "basic",
            killzones: [ 0.1, 1.1 ],
        },
        // 6
        {
            boxes: "basic",
            killzones: [ 0.3, 1.3 ],
        },
        // 7
        {
            loop: "level2-trans",
            boxes: "basic",
            killzones: [ 0.1, 0.2, 0.3 ],
        },
        // 8
        {
            loop: "level3",
            boxes: "basic",
            killzones: [ 1.1, 1.2, 1.3 ],
        },
        // level 2 - 1
        {
            loop: "level3",
            boxes: "basic",
            killzones: [ 1.1, 0.2, 1.3 ],
        },
        // 2
        {
            loop: "level3-alt",
            boxes: "basic",
            killzones: [ 0.1, 1.2, 0.3 ],
        },
        // 3
        {
            loop: "level3",
            boxes: "basic",
            killzones: [ 0.1, 1.1, 0.3, 1.3 ],
        },
        // 4
        {
            loop: "level3-alt",
            boxes: "basic",
            killzones: [ 0.1, 1.1, 0.2, 1.2 ],
        },
        // 5
        {
            loop: "level3",
            boxes: "basic",
            killzones: [ 0.2, 1.2, 0.3, 1.3 ],
        },
        // 6
        {
            loop: "level3-alt",
            boxes: "basic",
            killzones: [ 0.1, 0.2, 0.3 ],
        },
        // 7
        {
            loop: "level3-trans",
            boxes: "basic",
        },
        // 8
        {
            loop: "level4",
            boxes: "basic",
        },
        // level 3 - 1
        {
            loop: "level4",
            boxes: "basic",
        },
        // 2
        {
            loop: "level4-alt",
            boxes: "basic",
            keyholeinstruction: true,
        },
        // 3
        {
            loop: "level4",
            boxes: "basic",
            keyhole: "0.1",
            keyholeinstruction_hide: true,
        },
        // 4
        {
            loop: "level4-alt",
            boxes: "basic",
            keyhole: "0.3",
        },
        // 5
        {
            loop: "level4",
            boxes: "basic",
            keyhole: "0.2",
        },
        // 6
        {
            loop: "level4-alt",
            boxes: "basic",
            keyhole: "1.1",
        },
        // 7
        {
            loop: "level4",
            boxes: "basic",
            keyhole: "1.3",
        },
        // 8
        {
            loop: "level4-trans",
            boxes: "basic",
            keyhole: "1.2",
        },
        // level 4 - 1
        {
            loop: "level5",
            boxes: "basic",
            killzones: [ 0.1, 1.2, 0.3 ],
        },
        // 2
        {
            loop: "level5",
            boxes: "basic",
            keyhole: "1.2",
        },
        // 3
        {
            loop: "level5-alt",
            boxes: "basic",
            killzones: [ 1.1, 0.2, 1.3 ],
        },
        // 4
        {
            loop: "level5",
            boxes: "basic",
            keyhole: "0.2",
        },


        // extend...
        {
            loop: "level5",
            boxes: "basic",
            killzones: [ 1.1, 1.2, 0.3 ],
        },
        // 2
        {
            loop: "level5",
            boxes: "basic",
            keyhole: "0.2",
        },
        // 3
        {
            loop: "level5-alt",
            boxes: "basic",
            keyhole: "0.3",
        },
        // 4
        {
            loop: "level5",
            boxes: "basic",
            keyhole: "1.1",
        },


        // extend...
        {
            loop: "level5",
            boxes: "basic",
            killzones: [ 1.1, 1.2, 1.3 ],
        },
        // 2
        {
            loop: "level5",
            boxes: "basic",
            keyhole: "1.2",
        },
        // 3
        {
            loop: "level5-alt",
            boxes: "basic",
            killzones: [ 1.1, 1.2, 1.3, 0.2 ],
        },
        // 4
        {
            loop: "level5-alt",
            boxes: "basic",
        },


        // extend...
        {
            loop: "level5-hard",
            boxes: "basic",
        },
        {
            loop: "level5-hard",
            boxes: "basic",
        },
        {
            loop: "level5-hard",
            boxes: "basic",
            keyhole: "0.1",
        },
        // 2
        {
            loop: "level5-hard",
            boxes: "basic",
            keyhole: "1.3",
        },
        // 3
        {
            loop: "level5-hard",
            boxes: "basic",
            keyhole: "1.1",
        },
        // 4
        {
            loop: "level5-hard",
            boxes: "basic",
            keyhole: "0.3",
        },
        // 4
        {
            loop: "level5-hard",
            boxes: "basic",
            killzones: [ 1.1, 1.2, 1.3 ],
        },
        {
            loop: "level5-hard",
            boxes: "basic",
            keyhole: "1.3",
        },
        {
            loop: "level5-hard",
            boxes: "basic",
            killzones: [ 0.1, 1.2 ],
        },
        {
            loop: "level5-hard",
            boxes: "basic",
            keyhole: "0.3",
        },
        {
            loop: "level5-hard",
            boxes: "basic",
        },




        // extend...
        {
            loop: "level5-hardest",
            boxes: "basic",
        },
        {
            loop: "level5-hardest",
            boxes: "basic",
        },
        {
            loop: "level5-hardest",
            boxes: "basic",
            killzones: [ 1.1, 1.2, 1.3, 0.2 ],
        },
        // 2
        {
            loop: "level5-hardest",
            boxes: "basic",
            keyhole: "1.3",
        },
        // 3
        {
            loop: "level5-hardest",
            boxes: "basic",
            keyhole: "1.2",
        },
        // 4
        {
            loop: "level5-hardest",
            boxes: "basic",
            killzones: [ 0.1, 0.2, 0.3, 1.2 ],
        },
        // 4
        {
            loop: "level5-hardest",
            boxes: "basic",
            keyhole: "1.1",
        },
        {
            loop: "level5-hardest",
            boxes: "basic",
            killzones: [ 0.1, 1.2, 0.3 ],
        },
        {
            loop: "level5-hardest",
            boxes: "basic",
            keyhole: "0.3",
        },
        {
            loop: "level5-hardest",
            boxes: "basic",
            killzones: [ 0.1, 0.2, 0.3 ],
        },
        {
            loop: "level5-hardest",
            boxes: "basic",
            keyhole: "0.2",
        },
        {
            loop: "level5-hardest",
            boxes: "basic",
        },
        {
            loop: "level5-hardest",
            boxes: "basic",
        },



        // win
        {
            loop: "outro1",
            boxes: "endgame",
        },
        {
            loop: "outro2",
            boxes: "endgame",
            crown: true,
        },
        {
            loop: "outro2",
            boxes: "endgame",
        },
        {
            endgame: true
        },
];


var rooms = {
    "basic": [
                [10, 10000, 1800, 0, -1000, 0.25, 0xaaaaaa, 3],
                [10, 10000, 1800, 0, -1000, 0.5, 0xaaaaaa, 3],
                [10, 10000, 1800, 0, -1000, 0.75, 0xaaaaaa, 3],
                [10, 10000, 1800, 0, -1000, 1, 0xaaaaaa, 3],

                [10, 10000, 1800, 0, 1000, 0.25, 0xaaaaaa, 3],
                [10, 10000, 1800, 0, 1000, 0.5, 0xaaaaaa, 3],
                [10, 10000, 1800, 0, 1000, 0.75, 0xaaaaaa, 3],
                [10, 10000, 1800, 0, 1000, 1, 0xaaaaaa, 3],

                [2000, 10, 1800, -1666, 0, 0.25, 0xaaaaaa, 3],
                [2000, 10, 1800, -1666, 0, 0.5, 0xaaaaaa, 3],
                [2000, 10, 1800, -1666, 0, 0.75, 0xaaaaaa, 3],
                [2000, 10, 1800, -1666, 0, 1, 0xaaaaaa, 3],

                [2000, 10, 1800, 1666, 0, 0.25, 0xaaaaaa, 3],
                [2000, 10, 1800, 1666, 0, 0.5, 0xaaaaaa, 3],
                [2000, 10, 1800, 1666, 0, 0.75, 0xaaaaaa, 3],
                [2000, 10, 1800, 1666, 0, 1, 0xaaaaaa, 3],
             ],

    "endgame": [
                [10, 10000, 1800, 0, -1000, 0.25, 0xffcc00, 3],
                [10, 10000, 1800, 0, -1000, 0.5, 0xffcc00, 3],
                [10, 10000, 1800, 0, -1000, 0.75, 0xffcc00, 3],
                [10, 10000, 1800, 0, -1000, 1, 0xffcc00, 3],

                [10, 10000, 1800, 0, 1000, 0.25, 0xffcc00, 3],
                [10, 10000, 1800, 0, 1000, 0.5, 0xffcc00, 3],
                [10, 10000, 1800, 0, 1000, 0.75, 0xffcc00, 3],
                [10, 10000, 1800, 0, 1000, 1, 0xffcc00, 3],

             ],
};