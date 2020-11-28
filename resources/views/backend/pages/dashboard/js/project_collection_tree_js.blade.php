@php


@endphp
<script>

      var config = {
        container: "#tree_container",

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
</script>