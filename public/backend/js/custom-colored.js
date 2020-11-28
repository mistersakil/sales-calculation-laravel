var config = {
        container: "#custom-colored",

        nodeAlign: "BOTTOM",
        
        connectors: {
            type: 'step'
        },
        node: {
            HTMLclass: 'nodeExample1'
        }
    },
    revenue_collectoin = {
        HTMLclass: 'treant_blue',
        text: {
            name: "Revenue Collection",
        }
    },

    total_projects = {
        parent: revenue_collectoin,
        HTMLclass: 'treant_light_gray',
        childrenDropLevel: 1,        
        text:{
            name: "Total Projects",
            amount: "25",
        }
    },

    company = {
        parent: total_projects,
        HTMLclass: 'treant_light_gray',
        text:{
            name: "Company",
            amount: "25"
        }
    },
    bin = {
        parent: total_projects,
        HTMLclass: 'treant_light_gray',
        text:{
            name: "BIN",
            amount: "35"
        }
    },
    total_po_value = {
        parent: revenue_collectoin,
        HTMLclass: 'treant_light_gray',
        text:{
            name: "Total PO Value",
            amount: "1,50,000,000",
        }
    },
    
    collected_amount = {
        parent: total_po_value,
        HTMLclass: 'treant_light_gray',
        text:{
            name: "Collected Amount",
            amount: "1,50,000,000",
        }
    },


    advance_received = {
        parent: collected_amount,
        HTMLclass: 'treant_light_gray',
        text:{
            name: "Advance Received",
            amount: "50,000,000",
        }
    },

    received_after_implementation = {
        parent: collected_amount,
        HTMLclass: 'treant_light_gray',
        text:{
            name: "Received After Implementation",
            amount: "1,000,000",
        }
    },

    pending_amount = {
        parent: total_po_value,
        HTMLclass: 'treant_light_gray',
        childrenDropLevel: 2,
        text:{
            name: "Pending Amount",
            amount: "1,50,000,000",
        }
    },
    pending_on_po = {
        parent: pending_amount,
        HTMLclass: 'treant_light_gray',
        text:{
            name: "Pending on PO",
            amount: "1,50,000,000",
        }
    },
    pending_on_advance = {
        parent: pending_amount,
        HTMLclass: 'treant_light_gray',
        text:{
            name: "Pending on Advance",
            amount: "1,50,000,000",
        }
    };


    chart_config = [
        config,
        revenue_collectoin,total_po_value,total_projects,
        company, bin, collected_amount, pending_amount,
        advance_received, received_after_implementation, pending_on_po, pending_on_advance
    ];

    // Another approach, same result
    // JSON approach

/*
    var chart_config = {
        chart: {
            container: "#custom-colored",

            nodeAlign: "BOTTOM",

            connectors: {
                type: 'step'
            },
            node: {
                HTMLclass: 'nodeExample1'
            }
        },
        nodeStructure: {
            text: {
                name: "Mark Hill",
                title: "Chief executive officer",
                contact: "Tel: 01 213 123 134",
            },
            image: "../headshots/2.jpg",
            children: [
                {   
                    text:{
                        name: "Joe Linux",
                        title: "Chief Technology Officer",
                    },
                    image: "../headshots/1.jpg",
                    HTMLclass: 'treant_light_gray',
                    children: [
                        {
                            text:{
                                name: "Ron Blomquist",
                                title: "Chief Information Security Officer"
                            },
                            HTMLclass: 'treant_light_gray',
                            image: "../headshots/8.jpg"
                        },
                        {
                            text:{
                                name: "Michael Rubin",
                                title: "Chief Innovation Officer",
                                contact: "we@aregreat.com"
                            },
                            HTMLclass: 'treant_light_gray',
                            image: "../headshots/9.jpg"
                        }
                    ]
                },
                {
                    childrenDropLevel: 2,
                    text:{
                        name: "Linda May",
                        title: "Chief Business Officer",
                    },
                    HTMLclass: 'treant_light_gray',
                    image: "../headshots/5.jpg",
                    children: [
                        {
                            text:{
                                name: "Alice Lopez",
                                title: "Chief Communications Officer"
                            },
                            HTMLclass: 'treant_light_gray',
                            image: "../headshots/7.jpg"
                        },
                        {
                            text:{
                                name: "Mary Johnson",
                                title: "Chief Brand Officer"
                            },
                            HTMLclass: 'treant_light_gray',
                            image: "../headshots/4.jpg"
                        },
                        {
                            text:{
                                name: "Kirk Douglas",
                                title: "Chief Business Development Officer"
                            },
                            HTMLclass: 'treant_light_gray',
                            image: "../headshots/11.jpg"
                        }
                    ]
                },
                {
                    text:{
                        name: "John Green",
                        title: "Chief accounting officer",
                        contact: "Tel: 01 213 123 134",
                    },
                    HTMLclass: 'treant_gray',
                    image: "../headshots/6.jpg",
                    children: [
                        {
                            text:{
                                name: "Erica Reel",
                                title: "Chief Customer Officer"
                            },
                            link: {
                                href: "http://www.google.com"
                            },
                            HTMLclass: 'treant_gray',
                            image: "../headshots/10.jpg"
                        }
                    ]
                }
            ]
        }
    };

*/