Ext.require([
    'Ext.chart.*',
    'Ext.data.*',
    'Ext.panel.*'
    ]);

Ext.onReady(function() {
    
    Ext.define('StoreData1', {
        extend: 'Ext.data.Model',
        fields: [
        {
            name: 'pub_year' , 
            type: 'string'
        },

        {
            name: 'count_pub' , 
            type: 'decimal'
        }
        ]
    });
    
    var store = Ext.create('Ext.data.Store', {
        model: 'StoreData1',
        autoLoad: true,
        remoteSort: true,
        proxy: {
            type: 'ajax',
            url: "/RetrievalProject/cms/home/Chart1JSON",
            reader: {
                type: 'json'
            }
        }
    });
    
    chart = Ext.create('Ext.chart.Chart', {
        xtype: 'chart',
        id: 'chartCmp',
        animate: true,
        store: store,
        shadow: true,
        legend: {
            position: 'right'
        },
        insetPadding: 20,
        //theme: 'Base:gradients',
        series: [{
            type: 'pie',
            field: 'count_pub',
            showInLegend: true,
            tips: {
                trackMouse: true,
                width: 140,
                height: 28,
                renderer: function(storeItem, item) {
                    //calculate percentage.
                    var total = 0;
                    store.each(function(rec) {
                        total += parseInt(rec.get('count_pub'));
                    });

                    this.setTitle(Math.round(parseInt(storeItem.get('count_pub')) / total * 100) + '% จาก ' + total + " เอกสาร");
                }
            },
            highlight: {
                segment: {
                    margin: 20
                }
            },
            label: {
                field: 'pub_year',
                display: 'rotate',
                contrast: true,
                font: '18px Arial'
            }
        }]
    });

    Ext.define('StoreData2', {
        extend: 'Ext.data.Model',
        fields: [
        {
            name: 'lab_shname' , 
            type: 'string'
        },

        {
            name: 'count_pub' , 
            type: 'decimal'
        }
        ]
    });
    
    var store2 = Ext.create('Ext.data.Store', {
        model: 'StoreData2',
        autoLoad: true,
        remoteSort: true,
        proxy: {
            type: 'ajax',
            url: "/RetrievalProject/cms/home/Chart2JSON",
            reader: {
                type: 'json'
            }
        }
    });
    
    chart2 = Ext.create('Ext.chart.Chart', {
        xtype: 'chart',
        id: 'chartCmp2',
        animate: true,
        store: store2,
        shadow: true,
        legend: {
            position: 'right'
        },
        insetPadding: 20,
        //theme: 'Base:gradients',
        series: [{
            type: 'pie',
            field: 'count_pub',
            showInLegend: true,
            tips: {
                trackMouse: true,
                width: 140,
                height: 28,
                renderer: function(storeItem, item) {
                    //calculate percentage.
                    var total = 0;
                    store2.each(function(rec) {
                        total += parseInt(rec.get('count_pub'));
                    });

                    this.setTitle(Math.round(parseInt(storeItem.get('count_pub')) / total * 100) + '% จาก ' + total + " เอกสาร");
                }
            },
            highlight: {
                segment: {
                    margin: 20
                }
            },
            label: {
                field: 'lab_shname',
                display: 'rotate',
                contrast: true,
                font: '9px Arial',
                renderer: function (label)
                {
                // this will change the text displayed on the pie
                    var cmp = Ext.getCmp('chartCmp2'); // id of the chart
                    var index = cmp.store.findExact('lab_shname', label); // the field containing the current label
                    var data = cmp.store.getAt(index).data;
                    if(data.count_pub=='0'){
                      return '';  
                    }else{
                      var str = data.lab_shname;
                      var lab_shname = str.replace("Laboratory of ",""); 
                      return lab_shname; // the field containing the label to display on the chart   
                    }
                    
                }
            }
        }]
    });


    var panel2 = Ext.create('widget.panel', {
        width: 620,
        height: 350,
        renderTo: 'chart-2',
        layout: 'fit',
        items: chart2
    });
    
    var panel1 = Ext.create('widget.panel', {
        width: 510,
        height: 350,
        renderTo: 'chart-1',
        layout: 'fit',
        items: chart
    });
    

});

