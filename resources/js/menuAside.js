import {
  mdiAccountCircle,
  mdiMonitor,
  mdiSquareEditOutline,
  mdiTable,
  mdiViewList,
  mdiTelevisionGuide,
  mdiBarcodeScan,
  mdiDatabase,
  mdiPackage
} from "@mdi/js";

export default [
  {
    route: "dashboard",
    icon: mdiMonitor,
    label: "Dashboard",
  },
  {
    label: "Database",
    icon: mdiDatabase,
    menu: [
      {
        route: "product.index",
        label: "Products",
        icon: mdiPackage,
      },
    ],
  },

  {
    route: "sales",
    label: "Sales",
    icon: mdiBarcodeScan,
  },
  {
    route: "tables",
    label: "Tables",
    icon: mdiTable,
  },
  {
    route: "forms",
    label: "Forms",
    icon: mdiSquareEditOutline,
  },
  {
    route: "ui",
    label: "UI",
    icon: mdiTelevisionGuide,
  },
  {
    route: "profile",
    label: "Profile",
    icon: mdiAccountCircle,
  },
];
