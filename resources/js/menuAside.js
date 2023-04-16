import {
  mdiAccountCircle,
  mdiMonitor,
  mdiSquareEditOutline,
  mdiTable,
  mdiViewList,
  mdiTelevisionGuide,
  mdiBarcodeScan,
} from "@mdi/js";

export default [
  {
    route: "dashboard",
    icon: mdiMonitor,
    label: "Dashboard",
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
  {
    route: "sales",
    label: "Sales",
    icon: mdiBarcodeScan,
  },
  // {
  //   label: "Dropdown",
  //   icon: mdiViewList,
  //   menu: [
  //     {
  //       label: "Item One",
  //     },
  //     {
  //       label: "Item Two",
  //     },
  //   ],
  // },
];
